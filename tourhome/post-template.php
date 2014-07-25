<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-sortable.css">
    </head>
    
    <body>
        
        <!-- display post images -->
        Pictures:<br>
        
        <?php
            //get base directory
            $dirname = dirname(dirname(__FILE__)) . '/img/posts/{postid}/';
            //$images = glob($dirname."*");
            $images = glob($dirname."*.{jpg,png,gif,bmp}", GLOB_BRACE);
            echo "globbing dir: " . $dirname . '<br>';
            foreach($images as $image) {
                echo '<img src="'.$image.'" /><br />';
            }
            
        ?>
        
        
        User: {username}<br>
        Country: {country}<br>
        City: {city}<br>
        Description: {description}<br>
        Title: {post-title}<br>
        
        <?php
            //include delete, edit functionality here
        ?>

    </body>
</html>

