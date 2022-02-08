<?php
namespace Infusionsoft\WordPress\LandingPages;

if (!defined('ABSPATH')) {
    die();
}

class Admin {
    public function __construct() {
        add_action('admin_enqueue_scripts', array($this, 'adminEnqueueScripts'));
        add_action('admin_menu', array($this, 'showPluginMenu'));
        add_filter('plugin_action_links', array($this, 'pluginActionLinks'), 10, 2);
    }

    public function adminBodyClass($classes) {
        return "$classes infusionsoft_ilp";
    }

    public function adminEnqueueScripts($hook) {
        if ($hook !== 'settings_page_ilp-landingpages') {
            return;
        }
        add_filter('admin_body_class', array($this, 'adminBodyClass'));
        wp_enqueue_script('infusionsoft_ilp_js', INFUSIONSOFT_ILP_PLUGIN_URI . '/js/admin.js', array('jquery'), INFUSIONSOFT_ILP_PLUGIN_VERSION, true);
        wp_enqueue_style('infusionsoft_ilp_css', INFUSIONSOFT_ILP_PLUGIN_URI . '/css/admin.css', array(), INFUSIONSOFT_ILP_PLUGIN_VERSION);
    }

    public function editLandingPages() {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        $pages = Core::getInfusionsoftLandingPages();
        $add_errors = array();
        $update_errors = array();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['add'])) {
                $stub = !empty($_POST['stub'])
                    ? wp_parse_url(esc_url_raw('/' . trim($_POST['stub'], '/')), PHP_URL_PATH)
                    : '';
                $url = !empty($_POST['url']) ? sanitize_text_field($_POST['url']) : '';
                if ($stub === '' || $url === '') {
                    $add_errors['required'] = 'Please fill in all required fields.';
                }

                Core::getLandingPage($url);

                // Check for dupe slug
                foreach ($pages as $page) {
                    if ($page['stub'] === $stub) {
                        $add_errors['duplicate_slug'] = 'Cannot use existing slug or page name. Pease enter a different slug name.';
                        break;
                    }
                }

                if (empty($add_errors)) {
                    $id = wp_generate_uuid4();
                    $active = !empty($_POST['active']) ? (int) $_POST['active'] : 0;
                    $mode = !empty($_POST['mode']) ? sanitize_text_field($_POST['mode']) : 'embed';
                    $pages[$id] = array(
                        'active' => $active,
                        'mode' => strtolower(trim($mode)),
                        'stub' => $stub,
                        'url' => trim($url),
                        'title' => '',
                        'body' => '',
                        'id' => $id,
                        'created' => time(),
                    );
                    update_option('ILPPages', $pages, false);
                }
            } elseif (isset($_POST['update'])) {
                if (is_array($_POST['stub'])) {
                    foreach ($_POST['stub'] as $id_raw => $value_raw) {
                        $id = sanitize_key($id_raw);
                        $value = !empty($value_raw)
                            ? wp_parse_url(esc_url_raw('/' . trim($value_raw, '/')), PHP_URL_PATH)
                            : '';
                        $pages[$id]['stub'] = $value;
                        $pages[$id]['id'] = $id;
                    }
                }
                $keys = array('active', 'mode', 'url');
                foreach ($keys as $key) {
                    if (is_array($_POST[$key])) {
                        foreach ($_POST[$key] as $id_raw => $value_raw) {
                            $id = sanitize_key($id_raw);
                            $value = sanitize_text_field($value_raw);
                            $pages[$id][$key] = $value;
                            $pages[$id]['id'] = $id;
                        }
                    }
                }
                if (isset($_POST['delete']) && is_array($_POST['delete'])) {
                    foreach ($_POST['delete'] as $id_raw => $value_raw) {
                        $value = !empty($value_raw) ? sanitize_text_field($value_raw) : '';
                        if (!empty($value)) {
                            $id = sanitize_key($id_raw);
                            unset($pages[$id]);
                        }
                    }
                }

                // Make sure all required fields are filled in and there are no duplicate stubs after update.
                $dupe_check = array();
                foreach ($pages as $page) {
                    if ($page['stub'] === '' || $page['url'] === '') {
                        $update_errors['required'] = 'Please fill in all required fields.';
                    }
                    if (isset($dupe_check[$page['stub']])) {
                        $update_errors['duplicate_slug'] = 'Cannot use same slug or page name. Please enter a different slug name.';
                    } else {
                        $dupe_check[$page['stub']] = true;
                    }
                }

                if (empty($update_errors)) {
                    update_option('ILPPages', $pages, false);
                }
            }
        }
        ?>
<div class="wrap">
    <img src="<?= esc_url(INFUSIONSOFT_ILP_PLUGIN_URI . '/images/icon-256x256.png') ?>" alt="Infusionsoft Landing Pages">
    <form method="POST">
        <h3>Current Pages</h3><?php
        foreach ($update_errors as $update_error): ?>
        <p><span style="color: red"><?= esc_html($update_error) ?></span></p><?php
        endforeach; ?>
        <div style="width:800px;">
            <hr>
            <table class="widefat" style="white-space:nowrap;">
                <tr style="font-weight:bold;">
                    <th>Active</th>
                    <th>Type</th>
                    <th>Your URL Slug</th>
                    <th>View</th>
                    <th>Landing Page URL</th>
                    <th>Created</th>
                    <th>Views</th>
                    <th>Delete?</th>
                </tr><?php
        if (count($pages)):
            foreach ($pages as $id => $page):
                $page[$id]['created'] = empty($page[$id]['created']) ? time() : $page[$id]['created']; ?>
                <tr>
                    <td>
                        <select name="active[<?= esc_attr($id) ?>]">
                            <option value="1"<?php selected($page['active'], 1); ?>>Yes</option>
                            <option value="0"<?php selected($page['active'], 0); ?>>No</option>
                        </select>
                    </td>
                    <td>
                        <select name="mode[<?= esc_attr($id) ?>]">
                            <option value="iframe"<?php selected($page['mode'], 'iframe'); ?>>iFrame</option>
                            <option value="embed"<?php selected($page['mode'], 'embed'); ?>>Embed</option>
                            <option value="redirect"<?php selected($page['mode'], 'redirect'); ?>>Redirect</option>
                        </select>
                    </td>
                    <td>
                        <input name="stub[<?= esc_attr($id) ?>]" type="text" value="<?= esc_attr($page['stub']) ?>" size="50" required="required">
                        <br>
                    </td>
                    <td>( <a target="_blank" href="<?= esc_url($page['stub'] . '/') ?>">View</a> )</td>
                    <td>
                        <input name="url[<?= esc_attr($id) ?>]" type="text" value="<?= esc_attr($page['url']) ?>" size="50" required="required">
                        <br>
                    </td>
                    <td><?= date('d M Y', $page['created']) ?></td>
                    <td style="text-align:right;"><?= (int) get_option('ILPCounter_' . $id, 0) ?></td>
                    <td>
                        <input name="delete[<?= esc_attr($id) ?>]" type="checkbox" value="1">
                        <br>
                    </td>
                </tr><?php
            endforeach;
        else: ?>
                <tr><td colspan="99">You have no landing pages assigned.</td></tr><?php
        endif; ?>
            </table>
            <br>
            <input type="submit" name="update" value="Save Changes" class="button-primary">
        </div>
    </form>
    <form method="post"><?php
        foreach ($add_errors as $add_error): ?>
        <p><span style="color: red"><?= esc_html($add_error) ?></span></p><?php
        endforeach; ?>
        <label>Active</label>
        <select name="active">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
        <br>
        <label>Mode</label>
        <select name="mode">
            <option value="embed">Embed</option>
            <option value="iframe">iFrame</option>
            <option value="redirect">Redirect</option>
        </select>
        <br>
        <label>
            Slug
            <span class="infusionsoft_ilp_info">
                <span class="infusionsoft_ilp_more_text">
                    <br>
                    A "slug" is a part of a URL which identifies a particular page on a website in a form readable by
                    visitors. An example of this is /slug-name.
                </span>
            </span>
        </label>
        <input type="text" name="stub" size="40" required="required" placeholder="Enter your local slug here.  Ex:  /yoururl" style="vertical-align: top">
        <br>
        <label>Landing Page URL</label>
        <input name="url" type="url" size="80" required="required" placeholder="Paste your Infusionsoft Landing Page URL here.">
        <br><br>
        <input type="submit" name="add" value="Add Landing Page" class="button-primary">
    </form>
</div><?php
    }

    public function pluginActionLinks($links, $file) {
        if ($file === 'infusionsoft-landing-pages/index.php') {
            $links['settings'] = sprintf('<a href="%s"> %s </a>', admin_url('options-general.php?page=ilp-landingpages'), __('Settings', 'plugin_domain'));
            $links['support'] = sprintf('<a href="%s" target="_blank"> %s </a>', 'https://help.infusionsoft.com/contact-us', __('Support', 'plugin_domain'));
        }
        return $links;
    }

    public function showPluginMenu() {
        add_options_page(__('Infusionsoft Landing Pages'), __('Infusionsoft Landing Pages'), 'manage_options', 'ilp-landingpages', array($this, 'editLandingPages'));
    }
}

new Admin();
