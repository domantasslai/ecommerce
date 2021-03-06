DELETE FROM "permissions";
INSERT INTO "permissions" ("id", "key", "created_at", "updated_at", "table_name") VALUES
('1', 'browse_admin', '2020-08-04 18:08:12', '2020-08-04 18:08:12', NULL),
('2', 'browse_bread', '2020-08-04 18:08:12', '2020-08-04 18:08:12', NULL),
('3', 'browse_database', '2020-08-04 18:08:12', '2020-08-04 18:08:12', NULL),
('4', 'browse_media', '2020-08-04 18:08:12', '2020-08-04 18:08:12', NULL),
('5', 'browse_compass', '2020-08-04 18:08:12', '2020-08-04 18:08:12', NULL),
('6', 'browse_menus', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 'menus'),
('7', 'read_menus', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 'menus'),
('8', 'edit_menus', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 'menus'),
('9', 'add_menus', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 'menus'),
('10', 'delete_menus', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 'menus'),
('11', 'browse_roles', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 'roles'),
('12', 'read_roles', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 'roles'),
('13', 'edit_roles', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 'roles'),
('14', 'add_roles', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 'roles'),
('15', 'delete_roles', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 'roles'),
('16', 'browse_users', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 'users'),
('17', 'read_users', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 'users'),
('18', 'edit_users', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 'users'),
('19', 'add_users', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 'users'),
('20', 'delete_users', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 'users'),
('21', 'browse_settings', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 'settings'),
('22', 'read_settings', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 'settings'),
('23', 'edit_settings', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 'settings'),
('24', 'add_settings', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 'settings'),
('25', 'delete_settings', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 'settings'),
('26', 'browse_categories', '2020-08-04 18:08:13', '2020-08-04 18:08:13', 'categories'),
('27', 'read_categories', '2020-08-04 18:08:13', '2020-08-04 18:08:13', 'categories'),
('28', 'edit_categories', '2020-08-04 18:08:13', '2020-08-04 18:08:13', 'categories'),
('29', 'add_categories', '2020-08-04 18:08:13', '2020-08-04 18:08:13', 'categories'),
('30', 'delete_categories', '2020-08-04 18:08:13', '2020-08-04 18:08:13', 'categories'),
('31', 'browse_posts', '2020-08-04 18:08:13', '2020-08-04 18:08:13', 'posts'),
('32', 'read_posts', '2020-08-04 18:08:13', '2020-08-04 18:08:13', 'posts'),
('33', 'edit_posts', '2020-08-04 18:08:13', '2020-08-04 18:08:13', 'posts'),
('34', 'add_posts', '2020-08-04 18:08:13', '2020-08-04 18:08:13', 'posts'),
('35', 'delete_posts', '2020-08-04 18:08:13', '2020-08-04 18:08:13', 'posts'),
('36', 'browse_pages', '2020-08-04 18:08:13', '2020-08-04 18:08:13', 'pages'),
('37', 'read_pages', '2020-08-04 18:08:13', '2020-08-04 18:08:13', 'pages'),
('38', 'edit_pages', '2020-08-04 18:08:13', '2020-08-04 18:08:13', 'pages'),
('39', 'add_pages', '2020-08-04 18:08:13', '2020-08-04 18:08:13', 'pages'),
('40', 'delete_pages', '2020-08-04 18:08:13', '2020-08-04 18:08:13', 'pages'),
('41', 'browse_hooks', '2020-08-04 18:08:13', '2020-08-04 18:08:13', NULL),
('42', 'browse_products', '2020-08-04 18:22:14', '2020-08-04 18:22:14', 'products'),
('43', 'read_products', '2020-08-04 18:22:14', '2020-08-04 18:22:14', 'products'),
('44', 'edit_products', '2020-08-04 18:22:14', '2020-08-04 18:22:14', 'products'),
('45', 'add_products', '2020-08-04 18:22:14', '2020-08-04 18:22:14', 'products'),
('46', 'delete_products', '2020-08-04 18:22:14', '2020-08-04 18:22:14', 'products'),
('47', 'browse_category', '2020-08-04 18:33:03', '2020-08-04 18:33:03', 'category'),
('48', 'read_category', '2020-08-04 18:33:03', '2020-08-04 18:33:03', 'category'),
('49', 'edit_category', '2020-08-04 18:33:03', '2020-08-04 18:33:03', 'category'),
('50', 'add_category', '2020-08-04 18:33:03', '2020-08-04 18:33:03', 'category'),
('51', 'delete_category', '2020-08-04 18:33:03', '2020-08-04 18:33:03', 'category'),
('52', 'browse_coupons', '2020-08-04 18:34:10', '2020-08-04 18:34:10', 'coupons'),
('53', 'read_coupons', '2020-08-04 18:34:10', '2020-08-04 18:34:10', 'coupons'),
('54', 'edit_coupons', '2020-08-04 18:34:10', '2020-08-04 18:34:10', 'coupons'),
('55', 'add_coupons', '2020-08-04 18:34:10', '2020-08-04 18:34:10', 'coupons'),
('56', 'delete_coupons', '2020-08-04 18:34:10', '2020-08-04 18:34:10', 'coupons'),
('57', 'browse_category_product', '2020-08-04 18:42:29', '2020-08-04 18:42:29', 'category_product'),
('58', 'read_category_product', '2020-08-04 18:42:29', '2020-08-04 18:42:29', 'category_product'),
('59', 'edit_category_product', '2020-08-04 18:42:29', '2020-08-04 18:42:29', 'category_product'),
('60', 'add_category_product', '2020-08-04 18:42:29', '2020-08-04 18:42:29', 'category_product'),
('61', 'delete_category_product', '2020-08-04 18:42:29', '2020-08-04 18:42:29', 'category_product'),
('62', 'browse_orders', '2020-08-05 18:09:03', '2020-08-05 18:09:03', 'orders'),
('63', 'read_orders', '2020-08-05 18:09:03', '2020-08-05 18:09:03', 'orders'),
('64', 'edit_orders', '2020-08-05 18:09:03', '2020-08-05 18:09:03', 'orders'),
('65', 'add_orders', '2020-08-05 18:09:03', '2020-08-05 18:09:03', 'orders'),
('66', 'delete_orders', '2020-08-05 18:09:03', '2020-08-05 18:09:03', 'orders');
