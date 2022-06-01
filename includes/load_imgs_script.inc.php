<!-- js scripts for loading images on the article section -->
    <script type="text/javascript">
        const hero = document.getElementById("hero");
        if(hero != null)
            hero.style.backgroundImage = "url(<?php echo('/src/uploads/'.$line['p_img_url']);?>)";
        
        if(<?php if(is_null($line['a_img_profile'])) echo 0; else echo 1; ?>) {
            const imgContainer = document.getElementById("img-container");
            imgContainer.style.backgroundImage = "url(<?php echo('/src/uploads/profiles/'.$line['a_img_profile']);?>)";
        }
    </script>

    <script type="text/javascript">
        if(<?php if(is_null($_SESSION['user_img'])) echo 0; else echo 1; ?>) {
            const imgContainer = document.getElementById("profile-img");
            imgContainer.style.backgroundImage = "url(<?php echo('../src/uploads/profiles/'.$_SESSION['user_img']);?>)";
        }
    </script>