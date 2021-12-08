<?php
/**
 * The template for displaying blog
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

<div class="wp-block-cover alignfull" style="min-height:300px"><img loading="lazy" width="2048" height="1138" class="wp-block-cover__image-background wp-image-242" alt="" src="https://isahilarius.dk/kea/10_eksamensprojekt/almejaspace/wp-content/uploads/2021/07/Hero2.jpg" data-object-fit="cover" srcset="https://isahilarius.dk/kea/10_eksamensprojekt/almejaspace/wp-content/uploads/2021/07/Hero2.jpg 2048w, https://isahilarius.dk/kea/10_eksamensprojekt/almejaspace/wp-content/uploads/2021/07/Hero2-420x233.jpg 420w, https://isahilarius.dk/kea/10_eksamensprojekt/almejaspace/wp-content/uploads/2021/07/Hero2-800x445.jpg 800w, https://isahilarius.dk/kea/10_eksamensprojekt/almejaspace/wp-content/uploads/2021/07/Hero2-300x167.jpg 300w, https://isahilarius.dk/kea/10_eksamensprojekt/almejaspace/wp-content/uploads/2021/07/Hero2-1024x569.jpg 1024w, https://isahilarius.dk/kea/10_eksamensprojekt/almejaspace/wp-content/uploads/2021/07/Hero2-768x427.jpg 768w, https://isahilarius.dk/kea/10_eksamensprojekt/almejaspace/wp-content/uploads/2021/07/Hero2-1536x854.jpg 1536w, https://isahilarius.dk/kea/10_eksamensprojekt/almejaspace/wp-content/uploads/2021/07/Hero2-1140x633.jpg 1140w, https://isahilarius.dk/kea/10_eksamensprojekt/almejaspace/wp-content/uploads/2021/07/Hero2-920x511.jpg 920w, https://isahilarius.dk/kea/10_eksamensprojekt/almejaspace/wp-content/uploads/2021/07/Hero2-380x211.jpg 380w" sizes="(max-width: 2048px) 100vw, 2048px"><div class="wp-block-cover__inner-container">
<h2 class="has-text-align-center has-text-color" style="color:#e84a1e">PROJEKTGALLERI</h2>
</div></div>

	<section id="splash_section">
		 <h2 class="titel">BLOG</h2>
	</section>

	<template>
  			<article class="blog">
				   <p class="dato"></p>
                <img class="billede" src="" alt="">
				  <h4 class="overskrift"></h4>
        	</article>
        </template>

	<div id="primary" class="content-area">
		<section class="blogsection">
	<main id="main" class="site-main">

	<div class="tekst">
		<p>Velkommen til vores blog! Her deler vi nye gode idéer, farver, guides, tips og tricks 
		til inspiration til din næste farverige begivenhed eller stylingprojekt.</p>
	</div>

        <nav id="filtrering">
			<button data-blog="alle" >Alle</button>
		</nav>
		
        <section class="blogcontainer">
        </section>
		
        </main>
		</section>
 <script>


     let blogs;
	 let categories;
	 

     const dbUrl = "https://isahilarius.dk/kea/10_eksamensprojekt/almejaspace/wp-json/wp/v2/blog?per_page=100";
	const catUrl = "https://isahilarius.dk/kea/10_eksamensprojekt/almejaspace/wp-json/wp/v2/categories?slug=arstider,baeredygtighed,bryllup,inspiration";
     

    async function getJson() {
        const data = await fetch(dbUrl);
		const catdata = await fetch(catUrl);
        blogs = await data.json();
		categories = await catdata.json();
        console.log(categories);
        visBlogs();
		opretKnapper();
    }

	function opretKnapper() {
		categories.forEach(cat =>{ 
		document.querySelector("#filtrering").innerHTML += `<button class="filter" data-blog="${cat.id}">${cat.name}</button>`
		})
		addEventListenersToButtons();
	}

	function addEventListenersToButtons() {
	document.querySelectorAll("#filtrering button").forEach(elm =>{
		elm.addEventListener("click", filtrering);
	})
	}

	let filterBlog = "alle";
	
	function filtrering(){
		filterBlog = this.dataset.blog;
		console.log(filterBlog);

		visBlogs();
	}

    function visBlogs() {
    let temp = document.querySelector("template");
    let container = document.querySelector(".blogcontainer");
	container.innerHTML = "";
    blogs.forEach(blog => {
		if (filterBlog == "alle" || blog.categories.includes(parseInt(filterBlog))){
    let klon = temp.cloneNode(true).content;
 	klon.querySelector(".billede").src = blog.billede.guid;
	klon.querySelector(".dato").textContent = blog.dato;
	klon.querySelector(".overskrift").textContent = blog.title.rendered;
    klon.querySelector("article").addEventListener("click", ()=> {location.href = blog.link;})
    container.appendChild(klon);
	}
	})  
    }

    getJson();

</script>
		
</div>
	
<?php
do_action( 'botiga_do_sidebar' );
get_footer();
