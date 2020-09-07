<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;

class DataRowsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
      $postDataType = DataType::where('slug', 'posts')->firstOrFail();
      $pageDataType = DataType::where('slug', 'pages')->firstOrFail();
      $userDataType = DataType::where('slug', 'users')->firstOrFail();
      $categoryDataType = DataType::where('slug', 'categories')->firstOrFail();
      $menuDataType = DataType::where('slug', 'menus')->firstOrFail();
      $roleDataType = DataType::where('slug', 'roles')->firstOrFail();

      $dataRow = $this->dataRow($postDataType, 'id');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'number',
              'display_name' => 'ID',
              'required'     => 1,
              'browse'       => 0,
              'read'         => 0,
              'edit'         => 0,
              'add'          => 0,
              'delete'       => 0,
              'details'      => '',
              'order'        => 1,
          ])->save();
      }

      $dataRow = $this->dataRow($postDataType, 'author_id');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text',
              'display_name' => 'Author',
              'required'     => 1,
              'browse'       => 0,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 0,
              'delete'       => 1,
              'details'      => '',
              'order'        => 2,
          ])->save();
      }

      $dataRow = $this->dataRow($postDataType, 'category_id');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text',
              'display_name' => 'Category',
              'required'     => 1,
              'browse'       => 0,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 0,
              'details'      => '',
              'order'        => 3,
          ])->save();
      }

      $dataRow = $this->dataRow($postDataType, 'title');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text',
              'display_name' => 'Title',
              'required'     => 1,
              'browse'       => 1,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => '',
              'order'        => 4,
          ])->save();
      }

      $dataRow = $this->dataRow($postDataType, 'excerpt');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text_area',
              'display_name' => 'excerpt',
              'required'     => 1,
              'browse'       => 0,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => '',
              'order'        => 5,
          ])->save();
      }

      $dataRow = $this->dataRow($postDataType, 'body');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'rich_text_box',
              'display_name' => 'Body',
              'required'     => 1,
              'browse'       => 0,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => '',
              'order'        => 6,
          ])->save();
      }

      $dataRow = $this->dataRow($postDataType, 'image');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'image',
              'display_name' => 'Post Image',
              'required'     => 0,
              'browse'       => 1,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => json_encode([
                  'resize' => [
                      'width'  => '1000',
                      'height' => 'null',
                  ],
                  'quality'    => '70%',
                  'upsize'     => true,
                  'thumbnails' => [
                      [
                          'name'  => 'medium',
                          'scale' => '50%',
                      ],
                      [
                          'name'  => 'small',
                          'scale' => '25%',
                      ],
                      [
                          'name' => 'cropped',
                          'crop' => [
                              'width'  => '300',
                              'height' => '250',
                          ],
                      ],
                  ],
              ]),
              'order' => 7,
          ])->save();
      }

      $dataRow = $this->dataRow($postDataType, 'slug');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text',
              'display_name' => 'slug',
              'required'     => 1,
              'browse'       => 0,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => json_encode([
                  'slugify' => [
                      'origin'      => 'title',
                      'forceUpdate' => true,
                  ],
              ]),
              'order' => 8,
          ])->save();
      }

      $dataRow = $this->dataRow($postDataType, 'meta_description');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text_area',
              'display_name' => 'meta_description',
              'required'     => 1,
              'browse'       => 0,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => '',
              'order'        => 9,
          ])->save();
      }

      $dataRow = $this->dataRow($postDataType, 'meta_keywords');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text_area',
              'display_name' => 'meta_keywords',
              'required'     => 1,
              'browse'       => 0,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => '',
              'order'        => 10,
          ])->save();
      }

      $dataRow = $this->dataRow($postDataType, 'status');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'select_dropdown',
              'display_name' => 'status',
              'required'     => 1,
              'browse'       => 1,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => json_encode([
                  'default' => 'DRAFT',
                  'options' => [
                      'PUBLISHED' => 'published',
                      'DRAFT'     => 'draft',
                      'PENDING'   => 'pending',
                  ],
              ]),
              'order' => 11,
          ])->save();
      }

      $dataRow = $this->dataRow($postDataType, 'created_at');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'timestamp',
              'display_name' => 'created_at',
              'required'     => 0,
              'browse'       => 1,
              'read'         => 1,
              'edit'         => 0,
              'add'          => 0,
              'delete'       => 0,
              'details'      => '',
              'order'        => 12,
          ])->save();
      }

      $dataRow = $this->dataRow($postDataType, 'updated_at');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'timestamp',
              'display_name' => 'updated_at',
              'required'     => 0,
              'browse'       => 0,
              'read'         => 0,
              'edit'         => 0,
              'add'          => 0,
              'delete'       => 0,
              'details'      => '',
              'order'        => 13,
          ])->save();
      }

      $dataRow = $this->dataRow($pageDataType, 'id');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'number',
              'display_name' => 'id',
              'required'     => 1,
              'browse'       => 0,
              'read'         => 0,
              'edit'         => 0,
              'add'          => 0,
              'delete'       => 0,
              'details'      => '',
              'order'        => 1,
          ])->save();
      }

      $dataRow = $this->dataRow($pageDataType, 'author_id');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text',
              'display_name' => 'author_id',
              'required'     => 1,
              'browse'       => 0,
              'read'         => 0,
              'edit'         => 0,
              'add'          => 0,
              'delete'       => 0,
              'details'      => '',
              'order'        => 2,
          ])->save();
      }

      $dataRow = $this->dataRow($pageDataType, 'title');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text',
              'display_name' => 'title',
              'required'     => 1,
              'browse'       => 1,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => '',
              'order'        => 3,
          ])->save();
      }

      $dataRow = $this->dataRow($pageDataType, 'excerpt');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text_area',
              'display_name' => 'excerpt',
              'required'     => 1,
              'browse'       => 0,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => '',
              'order'        => 4,
          ])->save();
      }

      $dataRow = $this->dataRow($pageDataType, 'body');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'rich_text_box',
              'display_name' => 'body',
              'required'     => 1,
              'browse'       => 0,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => '',
              'order'        => 5,
          ])->save();
      }

      $dataRow = $this->dataRow($pageDataType, 'slug');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text',
              'display_name' => 'slug',
              'required'     => 1,
              'browse'       => 0,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => json_encode([
                  'slugify' => [
                      'origin' => 'title',
                  ],
              ]),
              'order' => 6,
          ])->save();
      }

      $dataRow = $this->dataRow($pageDataType, 'meta_description');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text',
              'display_name' => 'meta_description',
              'required'     => 1,
              'browse'       => 0,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => '',
              'order'        => 7,
          ])->save();
      }

      $dataRow = $this->dataRow($pageDataType, 'meta_keywords');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text',
              'display_name' => 'meta_keywords',
              'required'     => 1,
              'browse'       => 0,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => '',
              'order'        => 8,
          ])->save();
      }

      $dataRow = $this->dataRow($pageDataType, 'status');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'select_dropdown',
              'display_name' => 'status',
              'required'     => 1,
              'browse'       => 1,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => json_encode([
                  'default' => 'INACTIVE',
                  'options' => [
                      'INACTIVE' => 'INACTIVE',
                      'ACTIVE'   => 'ACTIVE',
                  ],
              ]),
              'order' => 9,
          ])->save();
      }

      $dataRow = $this->dataRow($pageDataType, 'created_at');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'timestamp',
              'display_name' => 'created_at',
              'required'     => 1,
              'browse'       => 1,
              'read'         => 1,
              'edit'         => 0,
              'add'          => 0,
              'delete'       => 0,
              'details'      => '',
              'order'        => 10,
          ])->save();
      }

      $dataRow = $this->dataRow($pageDataType, 'updated_at');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'timestamp',
              'display_name' => 'updated_at',
              'required'     => 1,
              'browse'       => 0,
              'read'         => 0,
              'edit'         => 0,
              'add'          => 0,
              'delete'       => 0,
              'details'      => '',
              'order'        => 11,
          ])->save();
      }

      $dataRow = $this->dataRow($pageDataType, 'image');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'image',
              'display_name' => 'image',
              'required'     => 0,
              'browse'       => 1,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => '',
              'order'        => 12,
          ])->save();
      }

      $dataRow = $this->dataRow($userDataType, 'id');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'number',
              'display_name' => 'id',
              'required'     => 1,
              'browse'       => 0,
              'read'         => 0,
              'edit'         => 0,
              'add'          => 0,
              'delete'       => 0,
              'details'      => '',
              'order'        => 1,
          ])->save();
      }

      $dataRow = $this->dataRow($userDataType, 'name');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text',
              'display_name' => 'name',
              'required'     => 1,
              'browse'       => 1,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => '',
              'order'        => 2,
          ])->save();
      }

      $dataRow = $this->dataRow($userDataType, 'email');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text',
              'display_name' => 'email',
              'required'     => 1,
              'browse'       => 1,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => '',
              'order'        => 3,
          ])->save();
      }

      $dataRow = $this->dataRow($userDataType, 'password');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'password',
              'display_name' => 'password',
              'required'     => 0,
              'browse'       => 0,
              'read'         => 0,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 0,
              'details'      => '',
              'order'        => 4,
          ])->save();
      }

      $dataRow = $this->dataRow($userDataType, 'user_belongsto_role_relationship');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'relationship',
              'display_name' => 'Role',
              'required'     => 0,
              'browse'       => 1,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 0,
              'details'      => '{"model":"TCG\\\\Voyager\\\\Models\\\\Role","table":"roles","type":"belongsToMany","column":"id","key":"id","label":"name","pivot_table":"user_roles","pivot":"1"}',
              'order'        => 10,
          ])->save();
      }

      $dataRow = $this->dataRow($userDataType, 'remember_token');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text',
              'display_name' => 'remember_token',
              'required'     => 0,
              'browse'       => 0,
              'read'         => 0,
              'edit'         => 0,
              'add'          => 0,
              'delete'       => 0,
              'details'      => '',
              'order'        => 5,
          ])->save();
      }

      $dataRow = $this->dataRow($userDataType, 'created_at');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'timestamp',
              'display_name' => 'created_at',
              'required'     => 0,
              'browse'       => 1,
              'read'         => 1,
              'edit'         => 0,
              'add'          => 0,
              'delete'       => 0,
              'details'      => '',
              'order'        => 6,
          ])->save();
      }

      $dataRow = $this->dataRow($userDataType, 'updated_at');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'timestamp',
              'display_name' => 'updated_at',
              'required'     => 0,
              'browse'       => 0,
              'read'         => 0,
              'edit'         => 0,
              'add'          => 0,
              'delete'       => 0,
              'details'      => '',
              'order'        => 7,
          ])->save();
      }

      $dataRow = $this->dataRow($userDataType, 'avatar');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'image',
              'display_name' => 'avatar',
              'required'     => 0,
              'browse'       => 1,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => '',
              'order'        => 8,
          ])->save();
      }

      $dataRow = $this->dataRow($menuDataType, 'id');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'number',
              'display_name' => 'id',
              'required'     => 1,
              'browse'       => 0,
              'read'         => 0,
              'edit'         => 0,
              'add'          => 0,
              'delete'       => 0,
              'details'      => '',
              'order'        => 1,
          ])->save();
      }

      $dataRow = $this->dataRow($menuDataType, 'name');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text',
              'display_name' => 'name',
              'required'     => 1,
              'browse'       => 1,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => '',
              'order'        => 2,
          ])->save();
      }

      $dataRow = $this->dataRow($menuDataType, 'created_at');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'timestamp',
              'display_name' => 'created_at',
              'required'     => 0,
              'browse'       => 0,
              'read'         => 0,
              'edit'         => 0,
              'add'          => 0,
              'delete'       => 0,
              'details'      => '',
              'order'        => 3,
          ])->save();
      }

      $dataRow = $this->dataRow($menuDataType, 'updated_at');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'timestamp',
              'display_name' => 'updated_at',
              'required'     => 0,
              'browse'       => 0,
              'read'         => 0,
              'edit'         => 0,
              'add'          => 0,
              'delete'       => 0,
              'details'      => '',
              'order'        => 4,
          ])->save();
      }

      $dataRow = $this->dataRow($categoryDataType, 'id');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'number',
              'display_name' => 'id',
              'required'     => 1,
              'browse'       => 0,
              'read'         => 0,
              'edit'         => 0,
              'add'          => 0,
              'delete'       => 0,
              'details'      => '',
              'order'        => 1,
          ])->save();
      }

      $dataRow = $this->dataRow($categoryDataType, 'parent_id');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'select_dropdown',
              'display_name' => 'parent_id',
              'required'     => 0,
              'browse'       => 0,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => json_encode([
                  'default' => '',
                  'null'    => '',
                  'options' => [
                      '' => '-- None --',
                  ],
                  'relationship' => [
                      'key'   => 'id',
                      'label' => 'name',
                  ],
              ]),
              'order' => 2,
          ])->save();
      }

      $dataRow = $this->dataRow($categoryDataType, 'order');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text',
              'display_name' => 'order',
              'required'     => 1,
              'browse'       => 1,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => json_encode([
                  'default' => 1,
              ]),
              'order' => 3,
          ])->save();
      }

      $dataRow = $this->dataRow($categoryDataType, 'name');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text',
              'display_name' => 'name',
              'required'     => 1,
              'browse'       => 1,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => '',
              'order'        => 4,
          ])->save();
      }

      $dataRow = $this->dataRow($categoryDataType, 'slug');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text',
              'display_name' => 'slug',
              'required'     => 1,
              'browse'       => 1,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => json_encode([
                  'slugify' => [
                      'origin' => 'name',
                  ],
              ]),
              'order' => 5,
          ])->save();
      }

      $dataRow = $this->dataRow($categoryDataType, 'created_at');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'timestamp',
              'display_name' => 'created_at',
              'required'     => 0,
              'browse'       => 0,
              'read'         => 1,
              'edit'         => 0,
              'add'          => 0,
              'delete'       => 0,
              'details'      => '',
              'order'        => 6,
          ])->save();
      }

      $dataRow = $this->dataRow($categoryDataType, 'updated_at');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'timestamp',
              'display_name' => 'updated_at',
              'required'     => 0,
              'browse'       => 0,
              'read'         => 0,
              'edit'         => 0,
              'add'          => 0,
              'delete'       => 0,
              'details'      => '',
              'order'        => 7,
          ])->save();
      }

      $dataRow = $this->dataRow($roleDataType, 'id');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'number',
              'display_name' => 'id',
              'required'     => 1,
              'browse'       => 0,
              'read'         => 0,
              'edit'         => 0,
              'add'          => 0,
              'delete'       => 0,
              'details'      => '',
              'order'        => 1,
          ])->save();
      }

      $dataRow = $this->dataRow($roleDataType, 'name');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text',
              'display_name' => 'Name',
              'required'     => 1,
              'browse'       => 1,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => '',
              'order'        => 2,
          ])->save();
      }

      $dataRow = $this->dataRow($roleDataType, 'created_at');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'timestamp',
              'display_name' => 'created_at',
              'required'     => 0,
              'browse'       => 0,
              'read'         => 0,
              'edit'         => 0,
              'add'          => 0,
              'delete'       => 0,
              'details'      => '',
              'order'        => 3,
          ])->save();
      }

      $dataRow = $this->dataRow($roleDataType, 'updated_at');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'timestamp',
              'display_name' => 'updated_at',
              'required'     => 0,
              'browse'       => 0,
              'read'         => 0,
              'edit'         => 0,
              'add'          => 0,
              'delete'       => 0,
              'details'      => '',
              'order'        => 4,
          ])->save();
      }

      $dataRow = $this->dataRow($roleDataType, 'display_name');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text',
              'display_name' => 'Display Name',
              'required'     => 1,
              'browse'       => 1,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => '',
              'order'        => 5,
          ])->save();
      }

      $dataRow = $this->dataRow($postDataType, 'seo_title');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text',
              'display_name' => 'seo_title',
              'required'     => 0,
              'browse'       => 1,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => '',
              'order'        => 14,
          ])->save();
      }

      $dataRow = $this->dataRow($postDataType, 'featured');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'checkbox',
              'display_name' => 'featured',
              'required'     => 1,
              'browse'       => 1,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => '',
              'order'        => 15,
          ])->save();
      }

      $dataRow = $this->dataRow($userDataType, 'role_id');
      if (!$dataRow->exists) {
          $dataRow->fill([
              'type'         => 'text',
              'display_name' => 'role_id',
              'required'     => 1,
              'browse'       => 1,
              'read'         => 1,
              'edit'         => 1,
              'add'          => 1,
              'delete'       => 1,
              'details'      => '',
              'order'        => 9,
          ])->save();
      }

      // Custom mano
      $productDataType = DataType::where('slug', 'products')->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        $dataRow = $this->dataRow($productDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{"validation":{"rule":"max:100"}}',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'slug');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'slug',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'details');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Details',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'price');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'price',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{"validation":{"rule":"required|regex:/^\\\d*(\\\.\\\d{1,2})?$/"}}',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'rich_text_box',
                'display_name' => 'Description',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'featured');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'checkbox',
                'display_name' => 'Featured',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{"on":"Yes","off":"No"}',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'image');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Image',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{"quality":"70%","thumbnails":[{"name":"medium","scale":"50%"},{"name":"small","scale":"25%"},{"name":"cropped","crop":{"width":"300","height":"250"}}]}',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'images');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'multiple_images',
                'display_name' => 'Images',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Created At',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 10,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Updated At',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 11,
            ])->save();
        }

        /*
        |--------------------------------------------------------------------------
        | Coupons
        |--------------------------------------------------------------------------
        */

        $couponDataType = DataType::where('slug', 'coupons')->firstOrFail();

        $dataRow = $this->dataRow($couponDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

       $dataRow = $this->dataRow($couponDataType, 'code');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'code',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($couponDataType, 'type');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Type',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{"default":"fixed","options":{"fixed":"Fixed Value","percent":"Percent Off"}}',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($couponDataType, 'value');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Value',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{"null":""}',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($couponDataType, 'percent_off');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Percent Off',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '{"null":""}',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($couponDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Created At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($couponDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Updated At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 7,
            ])->save();
        }

       /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        $categoryDataType = DataType::where('slug', 'category')->firstOrFail();

        $dataRow = $this->dataRow($categoryDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryDataType, 'slug');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Slug',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Created At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Updated At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }


       /*
        |--------------------------------------------------------------------------
        | Category Product
        |--------------------------------------------------------------------------
        */

        $categoryProductDataType = DataType::where('slug', 'category-product')->firstOrFail();

        $dataRow = $this->dataRow($categoryProductDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'hidden',
                'display_name' => 'Id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryProductDataType, 'product_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Product Id',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryProductDataType, 'category_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Category Id',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryProductDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Created At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryProductDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Updated At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }

        /*
        |--------------------------------------------------------------------------
        | Orders
        |--------------------------------------------------------------------------
        */

        $ordersDataType = DataType::where('slug', 'orders')->firstOrFail();

        $dataRow = $this->dataRow($ordersDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'hidden',
                'display_name' => 'Id',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '',
                'order' => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'user_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'number',
                'display_name' => 'User Id',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '',
                'order' => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_email');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'text',
                'display_name' => 'Billing Email',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 0,
                'details' => '',
                'order' => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'text',
                'display_name' => 'Billing Name',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 0,
                'details' => '',
                'order' => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_address');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'text',
                'display_name' => 'Billing Address',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 0,
                'details' => '',
                'order' => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_city');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'text',
                'display_name' => 'Billing City',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 0,
                'details' => '',
                'order' => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_province');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'text',
                'display_name' => 'Billing Province',
                'required' => 1,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 0,
                'details' => '',
                'order' => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_postalcode');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'text',
                'display_name' => 'Billing Postalcode',
                'required' => 1,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 0,
                'details' => '',
                'order' => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_phone');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'text',
                'display_name' => 'Billing Phone',
                'required' => 1,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 0,
                'details' => '',
                'order' => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_name_on_card');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'text',
                'display_name' => 'Billing Name On Card',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 0,
                'details' => '',
                'order' => 10,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_discount');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'number',
                'display_name' => 'Discount',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '',
                'order' => 11,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_discount_code');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'text',
                'display_name' => 'Discount Code',
                'required' => 0,
                'browse' => 0,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '',
                'order' => 12,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_subtotal');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'number',
                'display_name' => 'Subtotal',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '',
                'order' => 13,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_tax');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'number',
                'display_name' => 'Tax',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '',
                'order' => 14,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'billing_total');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'number',
                'display_name' => 'Total',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '',
                'order' => 15,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'payment_gateway');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'text',
                'display_name' => 'Payment Gateway',
                'required' => 1,
                'browse' => 0,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '',
                'order' => 16,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'shipped');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'checkbox',
                'display_name' => 'Shipped',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 0,
                'delete' => 0,
                'details' => '{"on":"Yes","off":"No"}',
                'order' => 17,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'error');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'text',
                'display_name' => 'Error',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '',
                'order' => 18,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'timestamp',
                'display_name' => 'Created At',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '',
                'order' => 19,
            ])->save();
        }

        $dataRow = $this->dataRow($ordersDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'timestamp',
                'display_name' => 'Updated At',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '',
                'order' => 20,
            ])->save();
        }

    }


    /**
     * [dataRow description].
     *
     * @param [type] $type  [description]
     * @param [type] $field [description]
     *
     * @return [type] [description]
     */
    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew([
            'data_type_id' => $type->id,
            'field'        => $field,
        ]);
    }
}
