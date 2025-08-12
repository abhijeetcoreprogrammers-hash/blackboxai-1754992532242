<?php
/**
 * HomeController
 * Handles homepage requests and data loading
 */

class HomeController extends Controller {
    public function index() {
        try {
            $categoryModel = $this->loadModel('CategoryModel');
            $tutorialModel = $this->loadModel('TutorialModel');

            // Get all active categories ordered by sort_order
            $categories = $categoryModel->findAll(['is_active' => 1], 'sort_order ASC');

            // Get featured tutorials ordered by published date descending
            $featuredTutorials = $tutorialModel->findAll(['is_featured' => 1, 'is_published' => 1], 'published_at DESC', 10);

            // Pass data to view
            $this->setTitle('Home');
            $this->setMetaDescription('Welcome to TPoint Tech Replica - Free Online Tutorials');
            $this->render('home/index', [
                'categories' => $categories,
                'featuredTutorials' => $featuredTutorials
            ]);
        } catch (Exception $e) {
            error_log('HomeController index error: ' . $e->getMessage());
            $this->render('errors/500', ['message' => 'An error occurred while loading the homepage.']);
        }
    }
}
?>
