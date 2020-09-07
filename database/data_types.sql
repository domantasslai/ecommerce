DELETE FROM "data_types";
INSERT INTO "data_types" ("id", "name", "slug", "display_name_singular", "display_name_plural", "icon", "model_name", "description", "generate_permissions", "created_at", "updated_at", "server_side", "controller", "policy_name", "details") VALUES
(1, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\Voyager\Models\User', '', '1', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 0, 'TCG\Voyager\Http\Controllers\VoyagerUserController', 'TCG\Voyager\Policies\UserPolicy', NULL),
(2, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\Voyager\Models\Menu', '', '1', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 0, '', NULL, NULL),
(3, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\Voyager\Models\Role', '', '1', '2020-08-04 18:08:12', '2020-08-04 18:08:12', 0, 'TCG\Voyager\Http\Controllers\VoyagerRoleController', NULL, NULL),
(4, 'categories', 'categories', 'Category', 'Categories', 'voyager-categories', 'TCG\Voyager\Models\Category', '', '1', '2020-08-04 18:08:13', '2020-08-04 18:08:13', 0, '', NULL, NULL),
(5, 'posts', 'posts', 'Post', 'Posts', 'voyager-news', 'TCG\Voyager\Models\Post', '', '1', '2020-08-04 18:08:13', '2020-08-04 18:08:13', 0, '', 'TCG\Voyager\Policies\PostPolicy', NULL),
(6, 'pages', 'pages', 'Page', 'Pages', 'voyager-file-text', 'TCG\Voyager\Models\Page', '', '1', '2020-08-04 18:08:13', '2020-08-04 18:08:13', 0, '', NULL, NULL),
(7, 'products', 'products', 'Product', 'Products', 'voyager-bag', 'App\Product', NULL, '1', '2020-08-04 18:22:14', '2020-08-05 18:27:37', 1, NULL, NULL, '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}'),
(8, 'category', 'category', 'Category', 'Categories', 'voyager-categories', 'App\Category', NULL, '1', '2020-08-04 18:33:03', '2020-08-04 18:33:03', 1, NULL, NULL, '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null}'),
(9, 'coupons', 'coupons', 'Coupon', 'Coupons', 'voyager-dollar', 'App\Coupon', NULL, '1', '2020-08-04 18:34:10', '2020-08-04 18:38:11', 1, NULL, NULL, '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}'),
(10, 'category_product', 'category-product', 'Category Product', 'Category Products', 'voyager-tag', 'App\CategoryProduct', NULL, '1', '2020-08-04 18:42:29', '2020-08-04 18:43:21', 1, NULL, NULL, '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}'),
(11, 'orders', 'orders', 'Order', 'Orders', 'voyager-documentation', 'App\Order', NULL, '1', '2020-08-05 18:09:03', '2020-08-05 18:44:05', 1, NULL, NULL, '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}');
