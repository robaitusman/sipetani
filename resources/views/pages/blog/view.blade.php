<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
   
    $pageTitle = $data['title'] ?? "Blog Details"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')

<style>
    .blog-detail-container {
        background: linear-gradient(135deg, #f8faff 0%, #e8f3ff 100%);
        min-height: 100vh;
    }
    
    .blog-header {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        color: white;
        padding: 60px 0 40px;
        margin-bottom: 0;
    }
    
    .back-btn {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
        padding: 12px 16px;
        border-radius: 12px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        backdrop-filter: blur(10px);
    }
    
    .back-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.3);
        color: white;
        text-decoration: none;
        transform: translateX(-5px);
    }
    
    .blog-hero {
        position: relative;
        height: 400px;
        overflow: hidden;
        border-radius: 0 0 30px 30px;
        margin-bottom: 40px;
    }
    
    .blog-hero img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .blog-hero::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(30, 64, 175, 0.1) 0%, rgba(59, 130, 246, 0.2) 100%);
    }
    
    .blog-content-wrapper {
        background: white;
        border-radius: 25px;
        box-shadow: 0 15px 40px rgba(59, 130, 246, 0.1);
        margin: -60px 20px 40px;
        position: relative;
        z-index: 10;
        overflow: hidden;
    }
    
    .blog-main-content {
        padding: 50px;
    }
    
    .blog-title {
        color: #1e40af;
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 25px;
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .blog-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
        margin-bottom: 35px;
        padding-bottom: 25px;
        border-bottom: 2px solid #e2e8f0;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #64748b;
        font-size: 0.95rem;
    }
    
    .meta-item i {
        color: #3b82f6;
        font-size: 1.1rem;
    }
    
    .meta-value {
        font-weight: 600;
        color: #1e40af;
    }
    
    .blog-content-text {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #374151;
        margin-bottom: 40px;
    }
    
    .blog-content-text p {
        margin-bottom: 20px;
    }
    
    .blog-sidebar {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
        padding: 40px 30px;
        border-radius: 25px;
        margin-bottom: 30px;
        position: sticky;
        top: 20px;
    }
    
    .sidebar-title {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 25px;
        text-align: center;
    }
    
    .info-card {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }
    
    .info-card:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-2px);
    }
    
    .info-label {
        font-size: 0.85rem;
        opacity: 0.8;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .info-value {
        font-size: 1rem;
        font-weight: 600;
        word-break: break-word;
    }
    
    .tags-container {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    
    .tag-item {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: capitalize;
    }
    
    .status-published {
        background: rgba(34, 197, 94, 0.2);
        color: #16a34a;
        border: 1px solid rgba(34, 197, 94, 0.3);
    }
    
    .status-draft {
        background: rgba(251, 191, 36, 0.2);
        color: #d97706;
        border: 1px solid rgba(251, 191, 36, 0.3);
    }
    
    .viewers-count {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.1);
        padding: 12px 18px;
        border-radius: 15px;
        font-weight: 600;
    }
    
    .no-record {
        text-align: center;
        padding: 100px 20px;
        background: white;
        border-radius: 25px;
        box-shadow: 0 15px 40px rgba(59, 130, 246, 0.1);
        margin: 40px 20px;
    }
    
    .no-record i {
        font-size: 4rem;
        color: #93c5fd;
        margin-bottom: 20px;
    }
    
    .no-record h4 {
        color: #1e40af;
        margin-bottom: 10px;
    }
    
    @media (max-width: 768px) {
        .blog-main-content {
            padding: 30px 25px;
        }
        
        .blog-title {
            font-size: 2rem;
        }
        
        .blog-meta {
            flex-direction: column;
            gap: 15px;
        }
        
        .blog-content-wrapper {
            margin: -30px 10px 20px;
        }
        
        .blog-hero {
            height: 250px;
        }
    }
    
    @media (max-width: 576px) {
        .blog-header {
            padding: 40px 0 20px;
        }
        
        .blog-main-content {
            padding: 25px 20px;
        }
        
        .blog-title {
            font-size: 1.8rem;
        }
    }
</style>

<section class="page blog-detail-container" data-page-type="view" data-page-url="{{ url()->full() }}">
    <?php if($show_header == true) { ?>
  
    <?php } ?>

    <div class="container-fluid px-0">
        <?php if($data) {
            $rec_id = ($data['id'] ? urlencode($data['id']) : null);
            
            // Generate fallback image URL if image is empty or doesn't exist
           $image_url = '';
if (!empty($data['image']) && file_exists(public_path($data['image']))) {
    $image_url = asset($data['image']);
} else {
    // Use Picsum Photos as fallback with seed based on ID
    $seed = $data['id'] ?? 'default';
    $image_url = "https://picsum.photos/seed/blogdetail{$seed}/1200/400";
}
        ?>
        
        <!-- Blog Hero Image -->
        <div class="blog-hero">
            <img src="{{ $image_url }}" alt="<?php echo htmlspecialchars($data['title'] ?? 'Blog Post'); ?>" id="blog-hero-image" />
        </div>

        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-12">
                    <div class="blog-content-wrapper">
                        <div class="blog-main-content">
                            <h1 class="blog-title"><?php echo htmlspecialchars($data['title'] ?? 'Untitled Post'); ?></h1>
                            
                            <div class="blog-meta">
                                <div class="meta-item">
                                    <i class="fas fa-user"></i>
                                    <span>By <span class="meta-value"><?php echo htmlspecialchars($data['aauth_users_username'] ?? 'Unknown Author'); ?></span></span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-calendar"></i>
                                    <span class="meta-value"><?php echo date('F j, Y', strtotime($data['date_created'] ?? 'now')); ?></span>
                                </div>
                               
                                
                            </div>

                            <div class="blog-content-text">
                                <?php echo $data['content'] ?? 'No content available.'; ?>
                            </div>

                            <?php if (!empty($data['tags'])) { ?>
                            <div class="mt-4">
                                <h6 class="text-muted mb-3">Tags:</h6>
                                <div class="tags-container">
                                    <?php 
                                    $tags = explode(',', $data['tags']);
                                    foreach($tags as $tag) {
                                        $tag = trim($tag);
                                        if (!empty($tag)) {
                                            echo '<span class="tag-item">' . htmlspecialchars($tag) . '</span>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

             
            </div>
        </div>

        <?php } else { ?>
        <!-- No Record Found -->
        <div class="container">
            <div class="no-record">
                <i class="fas fa-file-alt"></i>
                <h4>Blog Post Not Found</h4>
                <p class="text-muted">The blog post you're looking for doesn't exist or has been removed.</p>
                <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">
                    <i class="fas fa-arrow-left me-2"></i>Go Back
                </a>
            </div>
        </div>
        <?php } ?>
    </div>
</section>

<!-- Page custom js -->
<script>
$(document).ready(function(){
    // Handle image load errors with fallback
    $('#blog-hero-image').on('error', function() {
        const fallbackUrl = 'https://via.placeholder.com/1200x400/3b82f6/ffffff?text=Blog+Post+Image';
        if (this.src !== fallbackUrl) {
            this.src = fallbackUrl;
        }
    });
    
    // Add smooth entrance animation
    $('.blog-content-wrapper').css({
        'opacity': '0',
        'transform': 'translateY(30px)'
    }).animate({
        'opacity': '1'
    }, 800).css('transform', 'translateY(0)');
    
    // Animate sidebar cards
    $('.info-card').each(function(index) {
        $(this).css({
            'opacity': '0',
            'transform': 'translateX(20px)'
        });
        
        setTimeout(() => {
            $(this).css({
                'opacity': '1',
                'transform': 'translateX(0)',
                'transition': 'all 0.5s ease'
            });
        }, (index + 1) * 100);
    });
    
    // Add reading progress indicator
    $(window).scroll(function() {
        const windowHeight = $(window).height();
        const documentHeight = $(document).height();
        const scrollTop = $(window).scrollTop();
        const progress = (scrollTop / (documentHeight - windowHeight)) * 100;
        
        // You can add a progress bar here if needed
    });
    
    // Auto-link text URLs in content
    $('.blog-content-text').each(function() {
        const content = $(this).html();
        const linkedContent = content.replace(
            /(https?:\/\/[^\s<>"']+)/gi,
            '<a href="$1" target="_blank" rel="noopener noreferrer" class="text-primary">$1</a>'
        );
        $(this).html(linkedContent);
    });
    
    // Copy link functionality for share (you can add share buttons here)
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Show success message
            console.log('URL copied to clipboard');
        });
    }
});
</script>

@endsection