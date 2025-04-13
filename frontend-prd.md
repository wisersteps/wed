# PRD: Frontend Options Page UI

## Purpose
This document describes the layout and UI components of the WordPress plugin settings page, mimicking the Shopify plugin “Estimated Delivery Date - Plus.” It focuses on the *frontend tab UI*, used to manage display messages, date templates, and progress bar visuals.

---

## Page Structure

### 🧭 Tabs Navigation (Top)
There are **5 tabs at the top** of the settings page:
1. **Widget** *(selected by default)*
2. **Settings**
3. **Appearance**
4. **Advanced**
5. **Other**

Use HTML `ul > li` with `aria-selected` or `aria-controls` attributes for accessibility. Only one tab content is visible at a time.

---

## 🧱 Main Layout
Beneath the tabs, the page is split into **two columns**:

### 📐 Left Column (2/3 width)
Contains **UI cards with white background** for widget configuration.

### 📊 Right Column (1/3 width)
Contains **Preview**, **Save Info**, and **Support Help** cards.

---

## 🔍 Left Column – Card 1: Message Text Widget

### Title: `Message Text Widget`

#### 1. WYSIWYG Editor Field: “Message Text”
- Allow editing custom delivery message.
- Supports:
  - Font Size
  - Line Height
  - Text Color / Background Color
  - Bold, Italic, Underline, Strikethrough
  - Link insert/remove
  - Align Left, Center, Right, Justify
  - Undo / Redo
  - “Add Icon” Button
- Pre-filled example content:
  ```text
  Free Shipping to {country_flag} {country_name}
  Order within the next {cutoff_time} for dispatch today, and you'll receive your package between {order_delivered_minimum_date} and {order_delivered_maximum_date}
  ```

#### 2. Available Merge Tags (Variable List Below Editor)
- `{order_delivered_minimum_date}`
- `{order_delivered_maximum_date}`
- `{order_ready_minimum_date}`
- `{order_ready_maximum_date}`
- `{cutoff_time}`
- `{country_name}`
- `{country_name_advanced}`
- `{region_name}`
- `{country_flag}`
- `{country_flag_advanced}`
- `{country_code_us_flag}`
- `{country_code_ca_flag}`
- `{today_and_tomorrow}`

These should be listed as a vertical bullet list next to or below the editor. Highlighted as `code` elements.

#### 3. Buttons Below Editor:
- `Message Text Template`
- `Emoji Template`

Each is a button element with bordered style (can be used for saved preset insertion later).

---

## 🛑 Custom Out-of-Stock Message

- Field Type: **Radio buttons**
  - Option 1 (default): `None`
  - Option 2: `Custom message`
    - When selected, show another **WYSIWYG editor** like above.
    - Editor has same features as “Message Text”

Use JavaScript to dynamically toggle the visibility of the second editor based on radio selection.

---

## 📈 Card 2: Progress Bar Widget

### Title: `Progress Bar Widget`

#### 1. Progress Bar Mode:
- Field Type: Radio buttons
  - `Basic`
  - `Advanced`

#### 2. Order Status Tabs:
Visually styled as horizontal tabs:
- `Ordered`
- `Order Ready`
- `Order Delivered`

Only one visible at a time (tabbed interface).

#### For Each Status Tab:
##### - Icon Badge:
  - Select from icons (placeholder dropdown or SVG list)
##### - Order Status Title:
  - Single-line text input
##### - Order Delivered Date Title:
  - Input with pre-filled: `{order_delivered_minimum_date} - {order_delivered_maximum_date}`
##### - Order Status Tips Description:
  - Multiline text field (max 500 chars)
  - Example: `Estimated arrival date range : {order_delivered_minimum_date} - {order_delivered_maximum_date}`

---

## 🖼 Right Column (Sidebar Components) > Fixed when scrolling up and down

Widget Preview Box
- Section with:
  - “Add to Cart” Button mockup > Disabled and low opacity looking
  - Message Preview (styled card box)
  - Sample:  
    `Free Shipping to 🇺🇸 United States  
    Order within the next 13Hours 53Minutes for dispatch today, and you'll receive your package between Apr 28 and May 12.`
---

## Notes
- All field data should be stored using `update_option()` in WordPress.
- Use `settings_fields()` + `do_settings_sections()` if integrating into Settings API.
- Use separate sections for each tab using divs with IDs `tab-widget`, `tab-settings`, etc.
- Add JS to switch tabs without reloading the page.

---

## Goal
This page should act as the **admin interface for configuring all frontend display logic**, similar to the Shopify plugin. It should be rendered under a custom menu in **Settings → Estimated Delivery Date**.
