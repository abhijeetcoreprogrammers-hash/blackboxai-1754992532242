<?php
/**
 * TutorialModel
 * Handles database operations related to tutorials
 */

class TutorialModel extends Model {
    protected $table = 'tutorials';
    protected $primaryKey = 'id';
    protected $fillable = ['topic_id', 'title', 'slug', 'description', 'content', 'image_url', 'video_url', 'tutorial_type', 'difficulty_level', 'estimated_duration', 'view_count', 'like_count', 'is_featured', 'is_premium', 'is_published', 'sort_order', 'author_id', 'published_at'];
    protected $hidden = [];
}
?>
