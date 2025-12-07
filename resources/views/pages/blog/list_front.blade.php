<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages

    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "Blog"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')

<style>
    .blog-container {
        background: linear-gradient(135deg, #f8faff 0%, #e8f3ff 100%);
        min-height: 100vh;
        padding: 40px 0;
    }
    
    .blog-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(59, 130, 246, 0.1);
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .blog-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(59, 130, 246, 0.2);
        border-color: #3b82f6;
    }
    
    .blog-image {
        position: relative;
        overflow: hidden;
        height: 250px;
    }
    
    .blog-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .blog-card:hover .blog-image img {
        transform: scale(1.05);
    }
    
    .blog-image::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, transparent 0%, rgba(59, 130, 246, 0.1) 100%);
    }
    
    .blog-content {
        padding: 25px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .blog-title {
        color: #1e40af;
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 15px;
        line-height: 1.4;
        text-decoration: none;
        display: block;
    }
    
    .blog-title:hover {
        color: #3b82f6;
        text-decoration: none;
    }
    
    .blog-excerpt {
        color: #64748b;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 20px;
        flex-grow: 1;
    }
    
    .read-more-btn {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: inline-block;
        text-align: center;
        border: none;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }
    
    .read-more-btn:hover {
        background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .page-header {
        text-align: center;
        margin-bottom: 50px;
    }
    
    .page-header h1 {
        color: #1e40af;
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 15px;
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .page-header p {
        color: #64748b;
        font-size: 1.2rem;
        max-width: 600px;
        margin: 0 auto;
    }
    
    .filter-section {
        background: white;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 40px;
        box-shadow: 0 5px 15px rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.1);
    }
    
    .no-records {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.1);
        margin: 40px 0;
    }
    
    .no-records i {
        font-size: 4rem;
        color: #93c5fd;
        margin-bottom: 20px;
    }
    
    .no-records h4 {
        color: #1e40af;
        margin-bottom: 10px;
    }
    
    .pagination-wrapper {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-top: 40px;
        box-shadow: 0 5px 15px rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.1);
    }
    
    .card-link {
        text-decoration: none;
        color: inherit;
    }
    
    .card-link:hover {
        text-decoration: none;
        color: inherit;
    }
    
    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 2rem;
        }
        
        .blog-image {
            height: 200px;
        }
        
        .blog-content {
            padding: 20px;
        }
    }
</style>

<section class="page blog-container" data-page-type="list" data-page-url="{{ url()->full() }}">
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1>Artikel Kami</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div id="blog-list_front-records">
                    <?php if($total_records) { ?>
                        <div id="page-main-content">
                            <?php Html::page_bread_crumb("/blog/list_front", $field_name, $field_value); ?>
                            <?php Html::display_page_errors($errors); ?>
                         

                            <!-- Blog Grid -->
                            <div class="row g-4">
                                <?php
                                    $counter = 0;
                             foreach($records as $data){
    $rec_id = ($data['id'] ? urlencode($data['id']) : null);
    $counter++;
    
    // Debug: tampilkan path yang dihasilkan
    $original_path = $data['image']; // uploads/files/xxx.jpg
    $medium_path = getImgSizePath($data['image'], 'medium'); // uploads/files/medium/xxx.jpg
    $full_path = public_path($medium_path); // C:\laragon\www\sipetani\public\uploads\files\medium\xxx.jpg
    
    // Uncomment ini untuk debug
    // echo "Original: " . $original_path . "<br>";
    // echo "Medium Path: " . $medium_path . "<br>";
    // echo "Full Path: " . $full_path . "<br>";
    // echo "File Exists: " . (file_exists($full_path) ? 'YES' : 'NO') . "<br><br>";
    
    // Generate fallback image URL if image is empty or doesn't exist
    $image_url = '';
    if (!empty($data['image'])) {
        // Coba beberapa kemungkinan path
        $possible_paths = [
            getImgSizePath($data['image'], 'medium'), // uploads/files/medium/xxx.jpg
            'uploads/files/medium/' . basename($data['image']), // manual construct
            $data['image'] // original path
        ];
        
        foreach($possible_paths as $path) {
            if (file_exists(public_path($path))) {
                $image_url = asset($path);
                break;
            }
        }
    }
    
    // Jika tidak ada yang ketemu, pakai fallback
    if (empty($image_url)) {
        $seed = $data['id'] ?? $counter;
        $image_url = "https://picsum.photos/seed/blog{$seed}/400/250";
    }

                                ?>
                                <!-- Blog Card -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <article class="blog-card">
                                        <div class="blog-image">
                                            <img src="{{ $image_url }}" alt="<?php echo htmlspecialchars($data['title'] ?? 'Blog Post'); ?>" loading="lazy" />
                                        </div>
                                        
                                        <div class="blog-content">
                                            <a href="<?php print_link("blog/view/$rec_id"); ?>" class="blog-title">
                                                <?php echo htmlspecialchars($data['title'] ?? 'Untitled Post'); ?>
                                            </a>
                                            
                                            <div class="blog-excerpt">
                                                <?php echo str_truncate($data['content'] ?? 'No content available...', 120, '...'); ?>
                                            </div>
                                            
                                            <a href="<?php print_link("blog/view/$rec_id"); ?>" class="read-more-btn">
                                                Read More <i class="fas fa-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </article>
                                </div>
                                <?php } ?>
                            </div>
                            
                            <!-- Empty search results placeholder -->
                            <div class="row g-4 search-data d-none"></div>
                        </div>

                        <!-- Pagination -->
                        <?php if($show_footer) { ?>
                            <div class="pagination-wrapper">
                                <div class="row justify-content-between align-items-center">   
                                    <div class="col">   
                                        <?php
                                            if($show_pagination == true){
                                                $pager = new Pagination($total_records, $record_count);
                                                $pager->show_page_count = false;
                                                $pager->show_record_count = true;
                                                $pager->show_page_limit = false;
                                                $pager->limit = $limit;
                                                $pager->show_page_number_list = true;
                                                $pager->pager_link_range = 5;
                                                $pager->render();
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    <?php } else { ?>
                        <!-- No Records Found -->
                        <div class="no-records">
                            <i class="fas fa-newspaper"></i>
                            <h4>No Blog Posts Found</h4>
                            <p class="text-muted">We couldn't find any blog posts matching your criteria. Please try adjusting your search or check back later.</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Page custom js -->
<script>
$(document).ready(function(){
    // Custom JavaScript for blog list
    
    // Add loading animation for images
    $('.blog-card img').on('load', function() {
        $(this).addClass('loaded');
    });
    
    // Handle image load errors with additional fallback
    $('.blog-card img').on('error', function() {
        const fallbackUrl = 'https://via.placeholder.com/400x250/3b82f6/ffffff?text=Blog+Post';
        if (this.src !== fallbackUrl) {
            this.src = fallbackUrl;
        }
    });
    
    // Smooth scroll for pagination links
    $(document).on('click', '.pagination a', function(e) {
        $('html, body').animate({
            scrollTop: $('.blog-container').offset().top - 100
        }, 500);
    });
    
    // Add entrance animation
    $('.blog-card').each(function(index) {
        $(this).css({
            'opacity': '0',
            'transform': 'translateY(30px)'
        });
        
        setTimeout(() => {
            $(this).css({
                'opacity': '1',
                'transform': 'translateY(0)',
                'transition': 'all 0.6s ease'
            });
        }, index * 100);
    });
});
</script>

@endsection