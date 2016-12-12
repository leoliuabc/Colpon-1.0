<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url> 
    <loc>{{ url('/') }}</loc>
    <lastmod><?php echo date('Y-m-d',time()); ?></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.8</priority>    
  </url>
  @foreach ($stores as $store)
  <url> 
    <loc>{{ url('/lojas/'.$store->titleslug.'/'.$store->id) }}</loc>
    <lastmod><?php echo date('Y-m-d',time()); ?></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.6</priority>    
  </url>
  @endforeach
  @foreach ($offers as $offer)
  <url> 
    <loc>{{ url('/cupons/'.$offer->store_id.'/'.$offer->id) }}</loc>
    <lastmod><?php echo date('Y-m-d',time()); ?></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.4</priority>    
  </url>
  @endforeach
</urlset>