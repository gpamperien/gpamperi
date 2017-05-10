<?php

include_once 'includes/header.php';
require_once 'includes/login.php';
require_once 'includes/functions.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);


?>
<div id="index">
<p>Learn more about the women included in <i>Whitney Museum of American Art: Handbook of the Collection</i>.</p> 
<p>Use the visualization below to interact with collection data, or <a href="browse.php">browse artist biographies</a>.<p>
</div>

<div id="viz">
<div class='tableauPlaceholder' id='viz1494224940961' style='position: relative'><noscript><a href='#'><img alt='The Women of the Whitney Museum ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Th&#47;TheWomenoftheWhitneyMuseum&#47;Dashboard1&#47;1_rss.png' style='border: none' /></a></noscript><object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> <param name='site_root' value='' /><param name='name' value='TheWomenoftheWhitneyMuseum&#47;Dashboard1' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Th&#47;TheWomenoftheWhitneyMuseum&#47;Dashboard1&#47;1.png' /> <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' /><param name='display_spinner' value='yes' /><param name='display_overlay' value='yes' /><param name='display_count' value='yes' /></object></div>                <script type='text/javascript'>                    var divElement = document.getElementById('viz1494224940961');                    var vizElement = divElement.getElementsByTagName('object')[0];                    vizElement.style.width='1154px';vizElement.style.height='669px';                    var scriptElement = document.createElement('script');                    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>
</div>

<div id="credits">
<p>The following data were compiled based on information from www.whitney.org:<br>
Names, birth/death dates, birth places, number of works in the Whitney’s collection, 
and related exhibitions (since 2006). </p> 

<p>Biographies were collected from the Getty Institute's Union List of Artist Names (ULAN).</p> 

<p>Artistic styles and methods were compiled based on tags in the askART database.</p>
</div>

<?php
include_once 'includes/footer.php';
?>