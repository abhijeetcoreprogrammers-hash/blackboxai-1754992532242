<?php
/**
 * CategoryModel
 * Handles database operations related to tutorial categories
 */

class CategoryModel extends Model {
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'slug', 'description', 'image_url', 'icon_url', 'parent_id', 'sort_order', 'is_active', 'meta_title', 'meta_description'];
    protected $hidden = [];
}
?>
