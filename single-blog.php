<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Botiga
 */

get_header();
?>

	<div id="primary" class="content-area">
	<main id="main" class="site-main">
     <div class="goback_button">
		<button onclick="goBack()">Tilbage</button>
    </div>
		
		<article class="single_blog">
             <h2></h2>
			 <p class="beskrivelse"></p>
                <img src="" alt="">
            </article>

		</main>
 <script>
    let blog;
    const dbUrl = "https://isahilarius.dk/kea/10_eksamensprojekt/almejaspace/wp-json/wp/v2/blog/"+<?php echo get_the_ID() ?>;
     

    async function getJson() {
        const data = await fetch(dbUrl);
        blog = await data.json();
        visBlogs();
    }

    function visBlogs() {
	document.querySelector("h2").textContent = blog.title.rendered;
 	document.querySelector("img").src =  blog.billede.guid;
	document.querySelector(".beskrivelse").textContent = blog.beskrivelse;
	
} 

function goBack() {
  window.history.back();
}
    getJson();

</script>

</div>

<?php
do_action( 'botiga_do_sidebar' );
get_footer();