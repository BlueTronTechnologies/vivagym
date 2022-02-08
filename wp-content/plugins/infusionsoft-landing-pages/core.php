<?php
namespace Infusionsoft\WordPress\LandingPages;

if (!defined('ABSPATH')) {
    die();
}

class Core {
    public function __construct() {
        add_action('template_redirect', array($this, 'templateRedirect'), 1);
    }

    public function templateRedirect() {
        if (!is_404()) {
            return;
        }

        $landing_page = self::findMatchingInfusionsoftLandingPage($_SERVER['REQUEST_URI']);

        // Make sure we have a trailing slash
        if ($landing_page) {
            $url = wp_parse_url($_SERVER['REQUEST_URI']);

            if (substr($url['path'], -1) <> '/') {
                $new_url = $url['path'] . '/';
                if (!empty($url['query'])) {
                    $new_url .= '?' . $url['query'];
                }
                wp_redirect($new_url);
                exit;
            } else {
                self::renderInfusionsoftLandingPage($landing_page);
            }
        }
    }

    /**
     * @param $url
     * @return array|bool
     */
    public static function findMatchingInfusionsoftLandingPage($url) {
        $url = wp_parse_url($url);

        if (empty($url['path'])) {
            return false;
        }

        if (!empty($url['path'])) {
            if (substr($url['path'], -1) === '/') {
                $url['path'] = substr($url['path'], 0, -1);
            }
        }

        $result = false;

        if (!empty($url['path'])) {
            $pages = Core::getInfusionsoftLandingPages();

            foreach ($pages as $page) {
                if ($page['active']) {
                    if ($page['stub'] === $url['path']) {
                        $result = $page;
                        $result['thankyou'] = false;
                    }
                    if ($page['stub'] . '/thank-you.html' === $url['path']) {
                        $result = $page;
                        $result['thankyou'] = true;
                    }
                }
            }
        }

        return $result;
    }

    public static function getInfusionsoftLandingPages() {
        $pages = get_option('ILPPages', array());
        return $pages;
    }

    public static function getLandingPage($url) {
        $signature = 'ILPPageCache_' . sha1($url);
        $valid = true;
        $cached_page = get_option($signature, array('body' => '', 'time' => 1));

        if (!is_array($cached_page)
            || empty($cached_page['body'])
            || time() - $cached_page['time'] >= 30) {
            $valid = false;
        }

        if ($valid) {
            $cached_page['body'] .= '<!-- Cached -->';
        } else {
            $args = array('timeout' => 10);
            $content = wp_remote_get($url, $args);
            if (is_array($content) && isset($content['body'])) {
                $cached_page['body'] = $content['body'];
                $cached_page['time'] = time();
                if (!empty($cached_page['body'])) {
                    update_option($signature, $cached_page, false);
                }
            } elseif (is_wp_error($content)) {
                $error = $content->get_error_message();
                error_log($error);
            }
        }

        return $cached_page['body'];
    }

    public static function recordView($page) {
        if (!empty($page['thankyou'])) {
            return;
        }
        if (stripos($_SERVER['HTTP_ACCEPT'] === false, 'html')) {
            return;
        }
        if ($_SERVER['HTTP_ACCEPT'] === '*/*') {
            return;
        }

        $key = 'ILPCounter_' . $page['id'];
        $counter = get_option($key, 0);
        $counter++;
        update_option($key, $counter, false);
    }

    public static function renderInfusionsoftLandingPage($page) {
        $request = wp_parse_url($_SERVER['REQUEST_URI']);
        $url = $page['url'];

        header('HTTP/1.1 200 OK');

        if ($page['thankyou']) {
            $url .= '/thank-you.html';
        }
        if (!empty($request['query'])) {
            $url .= '?' . $request['query'];
        }

        self::recordView($page);

        if ($page['mode'] === 'embed') {
            $content = Core::getLandingPage($url);
            if (!empty($content)) {
                echo do_shortcode($content);
                die();
            }
            $page['mode'] = 'iframe';
        }

        if ($page['mode'] === 'iframe') {
    ?><html>
<head>
    <title><?= esc_html($page['title']) ?></title>
</head>
<body>
<iframe style="border:none; width:100%; height:100%; overflow:hidden;" src="<?= esc_url($url) ?>"><?= $page['body'] ?></iframe>
</body>
    </html><?php
            die();
        } elseif ($page['mode'] === 'redirect') {
            wp_redirect($url);
            die();
        }
    }
}

new Core();
