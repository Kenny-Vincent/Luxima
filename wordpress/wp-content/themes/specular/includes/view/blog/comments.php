<?php
$count = 0;
$comment_entries = get_comments(array( 'type'=> 'comment', 'post_id' => $post->ID ));
if(count($comment_entries) > 0){
    foreach($comment_entries as $comment){
        if($comment->comment_approved)
            $count++;
    }
}
?>
<div id="comments" class="header">
          <?php if($count == 1)
          $comm =__('Comment', 'specular');
          else
            $comm=__('Comments', 'specular');
        ?>
                        <h4 class="single_title"><?php echo esc_html($count) ?> <?php echo esc_attr($comm); ?></h4>
                      
                        <div class="row-fluid comments_list">
                            
                           <?php
                            if ( have_comments() ) : 
                                wp_list_comments( array(  'callback' => 'codeless_custom_comment', 'short_ping' => true ) );
                                paginate_comments_links(); 
                            endif;
                            ?>
                                                        
                        </div>
</div>

<?php comment_form(array('title_reply' => '<span>'. esc_html__('Leave Reply', 'specular'). '</span> ' ), $post->ID ) ?>


    
<?php
    
function codeless_custom_comment($comment, $args, $depth){
        
        ?>
                <div class="comment <?php if($depth == 1) echo 'span12'; else echo 'span11 offset1'; ?>">
                    
                            <div class="comment-wrapper">
                                <?php 
                                $avatar = get_avatar($comment, '64'); 

                                if( !empty( $avatar ) ): ?>
                                <div class="comment-avatar">
                                    <?php echo codeless_complex_esc( $avatar ); ?>
                                </div>
                                <?php endif; ?>

                                <div class="comment-content">
					                <span class="author"><a href=""><?php echo get_comment_author_link($comment) ?></a></span>
                                    <ul>
                                       
                                        <li><span><?php comment_date('M j Y', $comment) ?></span></li>
                                        <li><span><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span></li>
                                        <li><span> <?php edit_comment_link() ?></span></li>
                                    </ul>
                                    <div class="comment_text">
                                        <?php echo get_comment_text($comment); ?>
                                            <?php if ($comment->comment_approved == '0') : ?>
                                                    <span>Your comment is awaiting moderation.</span>
                                            <?php endif; ?>  
                                    </div>     
                                </div>
                            </div> 
                </div>
 <?php } ?>