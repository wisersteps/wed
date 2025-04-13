
# RULES.md

This file contains guidelines and best practices for creating a WooCommerce-compatible WordPress plugin. Please ensure all plugin code follows these rules.

---

## 1. WordPress & WooCommerce Plugin Requirements

### 1.1 Must-Have Basics

1. **WordPress Plugin Headers**  
   - Use standard WordPress plugin headers in the main file (`main-plugin.php`).
   - Example:
     ```php
     /**
      * Plugin Name: My Plugin
      * Plugin URI:  https://example.com
      * Description: A brief description of what this plugin does.
      * Version:     1.0.0
      * Author:      Your Name
      * Author URI:  https://example.com
      * Text Domain: my-plugin
      * Domain Path: /languages
      * License:     GPL v2 or later
      */
     ```

2. **Ensure GPL-Compatible Licensing**  
   - Plugins must be licensed under a GPL-compatible license.
   - All bundled code (libraries, dependencies) must also be GPL-compatible.

3. **Include a `readme.txt`**  
   - Should follow the WordPress readme format with sections like `=== Plugin Name ===`, `== Description ==`, `== Installation ==`, `== Changelog ==`, etc.

4. **Localization / Internationalization**  
   - Load the text domain using `load_plugin_textdomain()`.
   - Use `__()`, `_e()`, `_x()`, etc. for all translatable strings.
   - Store translation files in `/languages/`.

5. **Fail Gracefully Without WooCommerce**  
   - Do not throw fatal errors if WooCommerce is not active.
   - Check for WooCommerce with `class_exists( 'WooCommerce' )`.

6. **Compatibility Declaration**  
   - Declare minimum required and tested up to versions for WordPress, WooCommerce, and PHP.

---

## 1.2 Technical Requirements & Best Practices

1. **Follow WordPress Coding Standards**  
   - Follow [WordPress PHP Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/).
   - Use `phpcs` with WPCS if possible.

2. **Hooks & Filters**  
   - Integrate using `add_action()` and `add_filter()` with properly prefixed names.

3. **Sanitize Input and Escape Output**  
   - Use `sanitize_text_field()`, `esc_attr()`, `esc_html()`, `wp_nonce_field()`, etc.

4. **Nonces for Security**  
   - Protect all form submissions and sensitive operations with nonces.

5. **Load Assets Only When Needed**  
   - Enqueue styles/scripts only on pages where needed.

6. **No Obfuscated Code or Tracking Without Disclosure**

7. **Avoid Global Variables and Function Name Collisions**  
   - Use namespaces or unique prefixes.

---

## 2. Preferred Folder & File Structure

```
my-plugin/
│
├── admin/
│   ├── class-admin.php
│   ├── includes/
│   ├── templates/
│   └── assets/
│       ├── css/
│       ├── js/
│       └── img/
│
├── frontend/
│   ├── class-frontend.php
│   ├── includes/
│   ├── templates/
│   └── assets/
│       ├── css/
│       ├── js/
│       └── img/
│
├── main-plugin.php
├── gruntfile.js
├── package.json
├── readme.txt
└── languages/
```

---

## 3. Coding Style & Implementation Notes

1. **Namespace Usage**  
   - Use `MyPlugin\Admin`, `MyPlugin\Frontend`, etc. for namespacing classes.

2. **Main Plugin File**  
   - Define constants (version, path).
   - Include activator/deactivator logic.
   - Load frontend and admin classes.

3. **Enqueue Scripts and Styles**  
   - Admin assets in `admin/assets`, frontend in `frontend/assets`.
   - Minified `.min.css` and `.min.js` should be built with Grunt.

4. **Templates**  
   - Use separate `templates/` directories for admin and frontend.
   - Load with `include` or custom template loader class.

5. **JavaScript Standards (jQuery Required)**  
   - Use jQuery only.
   - All JS should be wrapped in a main plugin class (e.g., `MyPluginJS`) with functions inside.
   - Initialization should happen inside `jQuery(document).ready()`.

   Example:
   ```js
   var MyPluginJS = {
       init: function() {
           this.bindEvents();
       },
       bindEvents: function() {
           jQuery('.btn').on('click', this.handleClick);
       },
       handleClick: function(e) {
           e.preventDefault();
           alert('Clicked!');
       }
   };

   jQuery(document).ready(function() {
       MyPluginJS.init();
   });
   ```

6. **Translation**  
   - Use `__()`, `_e()` and load the text domain.
   - Generate `.pot` files with Grunt or WP-CLI.

7. **Grunt Usage**  
   - Automate:
     - CSS/JS minification
     - POT file generation
     - Optional: linting or live reload

---

## 4. WooCommerce Marketplace Requirements

1. **Comply with WooCommerce Code Reviews**  
   - Clean, modular, secure, and standards-compliant code.

2. **Don’t Use “WooCommerce” in Plugin Name Without Permission**

3. **Respect Privacy Laws**  
   - If collecting data or communicating externally, explain clearly and comply with GDPR/CCPA.

4. **Safe Deactivation and Uninstall**  
   - Avoid leaving behind data unless clearly explained.

5. **Avoid Checkout or Price Modification Unless Properly Handled**

---

**End of RULES.md**
