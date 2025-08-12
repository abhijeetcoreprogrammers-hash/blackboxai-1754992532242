-- TPoint Tech Replica - Sample Data Insertion Script
-- This script populates the database with realistic sample data

-- Note: USE statement removed to avoid conflicts with installer
-- Database selection is handled by the installer

-- Insert sample users
INSERT INTO users (username, email, password_hash, first_name, last_name, role, is_active, email_verified) VALUES
('admin', 'admin@tpointtech.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin', 'User', 'admin', TRUE, TRUE),
('instructor1', 'instructor@tpointtech.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'John', 'Doe', 'instructor', TRUE, TRUE),
('student1', 'student@tpointtech.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Jane', 'Smith', 'student', TRUE, TRUE);

-- Insert main categories (based on TPoint Tech website)
INSERT INTO categories (name, slug, description, image_url, icon_url, sort_order, is_active) VALUES
('Python', 'python', 'Learn Python programming from basics to advanced concepts', 'https://images.tpointtech.com/images/homeicon/python.png', 'https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/python.svg', 1, TRUE),
('Java', 'java', 'Complete Java programming tutorials and frameworks', 'https://images.tpointtech.com/images/homeicon/new/core-java.png', 'https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/Java.svg', 2, TRUE),
('JavaScript', 'javascript', 'Master JavaScript and modern web development', 'https://images.tpointtech.com/images/logo/javascripthome.png', 'https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/JS.svg', 3, TRUE),
('SQL', 'sql', 'Database management and SQL query tutorials', 'https://images.tpointtech.com/images/homeicon/sql.png', 'https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/SQL.svg', 4, TRUE),
('C Programming', 'c-programming', 'Learn C programming language fundamentals', 'https://images.tpointtech.com/images/homeicon/c-programming.png', 'https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/C.svg', 5, TRUE),
('C++', 'cpp', 'Object-oriented programming with C++', 'https://images.tpointtech.com/images/homeicon/cpp.png', 'https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/Cpp.svg', 6, TRUE),
('HTML', 'html', 'HTML markup language for web development', 'https://images.tpointtech.com/images/logo/html-tutorial.png', 'https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/HTML.svg', 7, TRUE),
('CSS', 'css', 'Cascading Style Sheets for web styling', 'https://images.tpointtech.com/images/logo/css3.jpg', 'https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/CSS.svg', 8, TRUE),
('React', 'react', 'Modern React.js library for building user interfaces', 'https://images.tpointtech.com/images/homeicon/react.png', 'https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/react.svg', 9, TRUE),
('Node.js', 'nodejs', 'Server-side JavaScript with Node.js', 'https://images.tpointtech.com/js/nodejs/images/nodejs-logo.png', 'https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/nodejs.svg', 10, TRUE),
('Spring Boot', 'spring-boot', 'Java Spring Boot framework tutorials', 'https://images.tpointtech.com/images/homeicon/spring-boot.png', 'https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/spring-boot.svg', 11, TRUE),
('C#', 'csharp', 'C# programming language and .NET framework', 'https://images.tpointtech.com/csharp/images/c-sharp-home.png', 'https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/csharp.svg', 12, TRUE),
('PHP', 'php', 'Server-side scripting with PHP', 'https://images.tpointtech.com/images/logo/php-logo.png', 'https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/PHP.svg', 13, TRUE),
('MySQL', 'mysql', 'MySQL database management system', 'https://images.tpointtech.com/images/homeicon/mysql.png', 'https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/mysql.svg', 14, TRUE),
('MongoDB', 'mongodb', 'NoSQL database with MongoDB', 'https://images.tpointtech.com/images/homeicon/mongodb.png', 'https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/mongodb.svg', 15, TRUE),
('Artificial Intelligence', 'ai', 'AI and machine learning concepts', 'https://images.tpointtech.com/images/homeicon/artificial-intelligence.png', 'https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/AI.svg', 16, TRUE),
('Machine Learning', 'ml', 'Machine learning algorithms and applications', 'https://images.tpointtech.com/images/homeicon/machine-learning.png', 'https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/ML.svg', 17, TRUE),
('Data Structures', 'dsa', 'Data structures and algorithms', 'https://images.tpointtech.com/images/homeicon/data-structures.png', 'https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/DS.svg', 18, TRUE),
('DBMS', 'dbms', 'Database management system concepts', 'https://images.tpointtech.com/images/homeicon/dbms.png', 'https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/DBMS.svg', 19, TRUE),
('Operating System', 'os', 'Operating system fundamentals', 'https://images.tpointtech.com/images/homeicon/operating-system.png', 'https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/OS.svg', 20, TRUE),
('Aptitude', 'aptitude', 'Quantitative aptitude and reasoning', 'https://images.tpointtech.com/images/homeicon/aptitude.png', 'https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/Aptitude.svg', 21, TRUE),
('Reasoning', 'reasoning', 'Logical reasoning and problem solving', 'https://images.tpointtech.com/images/homeicon/reasoning.png', 'https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/Reasoning.svg', 22, TRUE);

-- Insert topics for Python category
INSERT INTO topics (category_id, name, slug, description, image_url, difficulty_level, estimated_duration, sort_order) VALUES
(1, 'Python Basics', 'python-basics', 'Introduction to Python programming language', 'https://images.tpointtech.com/images/homeicon/python.png', 'beginner', 120, 1),
(1, 'Selenium Python', 'selenium-python', 'Web automation with Selenium and Python', 'https://images.tpointtech.com/images/homeicon/selenium-python.png', 'intermediate', 180, 2),
(1, 'Django', 'django', 'Web development with Django framework', 'https://images.tpointtech.com/images/homeicon/django.png', 'intermediate', 240, 3),
(1, 'Flask', 'flask', 'Lightweight web framework Flask', 'https://images.tpointtech.com/images/homeicon/flask.png', 'intermediate', 150, 4),
(1, 'NumPy', 'numpy', 'Numerical computing with NumPy', 'https://images.tpointtech.com/images/homeicon/numpy.png', 'intermediate', 90, 5),
(1, 'Pandas', 'pandas', 'Data manipulation with Pandas', 'https://images.tpointtech.com/images/homeicon/pandas.png', 'intermediate', 120, 6),
(1, 'Matplotlib', 'matplotlib', 'Data visualization with Matplotlib', 'https://images.tpointtech.com/images/homeicon/matplotlib.png', 'intermediate', 100, 7),
(1, 'PyTorch', 'pytorch', 'Deep learning with PyTorch', 'https://images.tpointtech.com/images/homeicon/pytorch.png', 'advanced', 200, 8);

-- Insert topics for Java category
INSERT INTO topics (category_id, name, slug, description, image_url, difficulty_level, estimated_duration, sort_order) VALUES
(2, 'Core Java', 'core-java', 'Java programming fundamentals', 'https://images.tpointtech.com/images/homeicon/new/core-java.png', 'beginner', 180, 1),
(2, 'Java Servlet', 'java-servlet', 'Server-side Java with Servlets', 'https://images.tpointtech.com/images/homeicon/new/servlet.png', 'intermediate', 150, 2),
(2, 'JSP', 'jsp', 'JavaServer Pages for web development', 'https://images.tpointtech.com/images/homeicon/jsp.png', 'intermediate', 120, 3),
(2, 'Spring Framework', 'spring-framework', 'Enterprise Java with Spring', 'https://images.tpointtech.com/images/homeicon/spring.png', 'advanced', 240, 4),
(2, 'Hibernate', 'hibernate', 'Object-relational mapping with Hibernate', 'https://images.tpointtech.com/images/homeicon/hibernate.png', 'advanced', 180, 5);

-- Insert sample tutorials
INSERT INTO tutorials (topic_id, title, slug, description, content, image_url, tutorial_type, difficulty_level, estimated_duration, is_featured, is_published, sort_order, author_id, published_at) VALUES
(1, 'Python Introduction', 'python-introduction', 'Learn the basics of Python programming language', 'Python is a high-level, interpreted programming language with dynamic semantics. Its high-level built-in data structures, combined with dynamic typing and dynamic binding, make it very attractive for Rapid Application Development...', 'https://images.tpointtech.com/images/homeicon/python.png', 'article', 'beginner', 30, TRUE, TRUE, 1, 2, NOW()),
(1, 'Python Variables and Data Types', 'python-variables-data-types', 'Understanding variables and data types in Python', 'Variables are containers for storing data values. Python has no command for declaring a variable. A variable is created the moment you first assign a value to it...', 'https://images.tpointtech.com/images/homeicon/python.png', 'article', 'beginner', 45, TRUE, TRUE, 2, 2, NOW()),
(1, 'Python Control Structures', 'python-control-structures', 'Learn about if-else, loops, and control flow in Python', 'Control structures allow you to control the flow of your program execution. Python provides several control structures including if-else statements, for loops, while loops...', 'https://images.tpointtech.com/images/homeicon/python.png', 'article', 'beginner', 60, FALSE, TRUE, 3, 2, NOW()),
(2, 'Selenium WebDriver Basics', 'selenium-webdriver-basics', 'Introduction to Selenium WebDriver with Python', 'Selenium WebDriver is a web framework that permits you to execute cross-browser tests. This tool is used for automating web-based application testing...', 'https://images.tpointtech.com/images/homeicon/selenium-python.png', 'article', 'intermediate', 90, TRUE, TRUE, 1, 2, NOW()),
(5, 'Core Java Fundamentals', 'core-java-fundamentals', 'Learn Java programming from scratch', 'Java is a high-level, class-based, object-oriented programming language that is designed to have as few implementation dependencies as possible...', 'https://images.tpointtech.com/images/homeicon/new/core-java.png', 'article', 'beginner', 120, TRUE, TRUE, 1, 2, NOW());

-- Insert tags
INSERT INTO tags (name, slug, color) VALUES
('Programming', 'programming', '#007bff'),
('Web Development', 'web-development', '#28a745'),
('Data Science', 'data-science', '#ffc107'),
('Machine Learning', 'machine-learning', '#dc3545'),
('Database', 'database', '#6f42c1'),
('Framework', 'framework', '#fd7e14'),
('Beginner', 'beginner', '#20c997'),
('Advanced', 'advanced', '#e83e8c');

-- Link tutorials with tags
INSERT INTO tutorial_tags (tutorial_id, tag_id) VALUES
(1, 1), (1, 7), -- Python Introduction: Programming, Beginner
(2, 1), (2, 7), -- Python Variables: Programming, Beginner
(3, 1), (3, 7), -- Python Control: Programming, Beginner
(4, 1), (4, 2), -- Selenium: Programming, Web Development
(5, 1), (5, 7); -- Core Java: Programming, Beginner

-- Insert code examples
INSERT INTO code_examples (tutorial_id, title, code, language, description, sort_order) VALUES
(1, 'Hello World in Python', 'print("Hello, World!")', 'python', 'Basic Python print statement', 1),
(2, 'Variable Declaration', 'name = "John"\nage = 25\nheight = 5.9', 'python', 'Examples of different variable types', 1),
(3, 'If-Else Statement', 'age = 18\nif age >= 18:\n    print("Adult")\nelse:\n    print("Minor")', 'python', 'Basic conditional statement', 1),
(5, 'Hello World in Java', 'public class HelloWorld {\n    public static void main(String[] args) {\n        System.out.println("Hello, World!");\n    }\n}', 'java', 'Basic Java program structure', 1);

-- Insert interview questions
INSERT INTO interview_questions (category_id, question, answer, difficulty_level, question_type, is_featured) VALUES
(1, 'What is Python and what are its key features?', 'Python is a high-level, interpreted programming language. Key features include: 1) Easy to learn and use, 2) Interpreted language, 3) Object-oriented, 4) Free and open source, 5) Portable, 6) Rich library support', 'easy', 'technical', TRUE),
(1, 'Explain the difference between list and tuple in Python', 'Lists are mutable (can be changed) while tuples are immutable (cannot be changed). Lists use square brackets [] while tuples use parentheses (). Lists are slower than tuples for iteration.', 'medium', 'technical', TRUE),
(2, 'What is the difference between JDK, JRE, and JVM?', 'JVM (Java Virtual Machine) executes Java bytecode. JRE (Java Runtime Environment) includes JVM plus libraries needed to run Java applications. JDK (Java Development Kit) includes JRE plus development tools like compiler.', 'easy', 'technical', TRUE),
(2, 'Explain Object-Oriented Programming concepts in Java', 'OOP concepts in Java include: 1) Encapsulation - bundling data and methods, 2) Inheritance - creating new classes based on existing ones, 3) Polymorphism - same interface for different data types, 4) Abstraction - hiding implementation details', 'medium', 'technical', FALSE);

-- Insert compilers
INSERT INTO compilers (name, language, version, description, sort_order) VALUES
('Python Online Compiler', 'python', '3.9', 'Execute Python code online', 1),
('Java Online Compiler', 'java', '11', 'Compile and run Java programs', 2),
('C Online Compiler', 'c', 'GCC 9.3', 'Compile and execute C programs', 3),
('C++ Online Compiler', 'cpp', 'G++ 9.3', 'Compile and execute C++ programs', 4),
('JavaScript Online Editor', 'javascript', 'ES6', 'Run JavaScript code in browser', 5),
('HTML/CSS Editor', 'html', 'HTML5', 'Create and preview HTML pages', 6);

-- Insert system settings
INSERT INTO settings (setting_key, setting_value, setting_type, description, is_public) VALUES
('site_name', 'TPoint Tech Replica', 'string', 'Website name', TRUE),
('site_description', 'Free online tutorials for programming and technology', 'string', 'Website description', TRUE),
('tutorials_per_page', '20', 'integer', 'Number of tutorials per page', FALSE),
('enable_comments', 'true', 'boolean', 'Enable comments on tutorials', FALSE),
('maintenance_mode', 'false', 'boolean', 'Enable maintenance mode', FALSE);

-- Insert sample page views for analytics
INSERT INTO page_views (page_type, page_id, user_id, ip_address, user_agent, referrer, session_id, viewed_at) VALUES
('home', NULL, 3, '192.168.1.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', 'https://google.com', 'sess_123', NOW()),
('tutorial', 1, 3, '192.168.1.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', 'https://tpointtech.com', 'sess_123', NOW()),
('category', 1, NULL, '192.168.1.2', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36', 'https://google.com', 'sess_456', NOW());

-- Update view counts for tutorials
UPDATE tutorials SET view_count = FLOOR(RAND() * 1000) + 100 WHERE id IN (1, 2, 3, 4, 5);

-- Insert newsletter subscriptions
INSERT INTO newsletter_subscriptions (email, name) VALUES
('subscriber1@example.com', 'John Subscriber'),
('subscriber2@example.com', 'Jane Newsletter'),
('subscriber3@example.com', 'Tech Enthusiast');

-- Create some user progress records
INSERT INTO user_progress (user_id, tutorial_id, progress_percentage, completed_at) VALUES
(3, 1, 100.00, NOW()),
(3, 2, 75.50, NULL),
(3, 3, 25.00, NULL);

-- Create some bookmarks
INSERT INTO user_bookmarks (user_id, tutorial_id) VALUES
(3, 1),
(3, 4),
(3, 5);

-- Insert sample comments
INSERT INTO comments (tutorial_id, user_id, content, is_approved, like_count) VALUES
(1, 3, 'Great tutorial! Very helpful for beginners.', TRUE, 5),
(1, 3, 'Thanks for the clear explanation.', TRUE, 2),
(2, 3, 'Could you add more examples?', TRUE, 1);

-- Note: Indexes are now created in schema.sql to avoid duplicates

-- Create views for commonly used queries
CREATE VIEW featured_tutorials AS
SELECT 
    t.id,
    t.title,
    t.slug,
    t.description,
    t.image_url,
    t.view_count,
    t.like_count,
    t.published_at,
    tp.name as topic_name,
    c.name as category_name,
    c.slug as category_slug
FROM tutorials t
JOIN topics tp ON t.topic_id = tp.id
JOIN categories c ON tp.category_id = c.id
WHERE t.is_featured = TRUE AND t.is_published = TRUE
ORDER BY t.published_at DESC;

CREATE VIEW popular_tutorials AS
SELECT 
    t.id,
    t.title,
    t.slug,
    t.description,
    t.image_url,
    t.view_count,
    t.like_count,
    t.published_at,
    tp.name as topic_name,
    c.name as category_name,
    c.slug as category_slug
FROM tutorials t
JOIN topics tp ON t.topic_id = tp.id
JOIN categories c ON tp.category_id = c.id
WHERE t.is_published = TRUE
ORDER BY t.view_count DESC, t.like_count DESC;

CREATE VIEW category_stats AS
SELECT 
    c.id,
    c.name,
    c.slug,
    COUNT(DISTINCT tp.id) as topic_count,
    COUNT(DISTINCT t.id) as tutorial_count,
    SUM(t.view_count) as total_views
FROM categories c
LEFT JOIN topics tp ON c.id = tp.category_id
LEFT JOIN tutorials t ON tp.id = t.topic_id AND t.is_published = TRUE
WHERE c.is_active = TRUE
GROUP BY c.id, c.name, c.slug
ORDER BY tutorial_count DESC;
