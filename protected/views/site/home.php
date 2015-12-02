<?php
/* @var $this CombinedLoginController */

$this->breadcrumbs=array(
	'Combined Login'=>array('/combinedLogin'),
	'Home',
);

?>
<div style="width: 1500px;">
<div style="float:left; ">

<?php
            $sites = $model->listAllSites();
           /* Create a carousel which populates each item automatically with sites from PortalSites table
            $carouselData = array();
            foreach($sites as $s)
            {
                array_push($carouselData, array('image' => '/JobFair/images/imgs/slider4.gif', 'label' => '<a href="http://www.google.com">'.$s['name'].'</a>'));
            }
            var_dump($carouselData);
            * 
            */
            $this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
                'heading' => 'Welcome!',
                ));
            
            echo 'Welcome to the Senior Project Tools Portal! Below is information and links our growing Senior Project Tools Sites.';
            $this->endWidget();
            // The scrolling image.
            $this->beginWidget('bootstrap.widgets.TbCarousel', array(
                'items' => array(
                    array('image' => '/JobFair/images/spt_images/vjf.JPG', 'link' => 'http://vjf-dev.cis.fiu.edu/', 'label' => 'Virtual Job Fair', 'caption' => 'Provides an efficient way to make a connection between employers and job seeking students. Provides easy access to job postings, and supplies other reseources such as the ability to upload a video resume.'),
                    array('image' => '/JobFair/images/spt_images/cp.JPG', 'link' => '/JobFair/index.php/site/requestLogin', 'label' => 'Collaborative Platform', 'caption' => 'Provides students an effective way to communicate with mentors and project team members.'),
                    array('image' => '/JobFair/images/spt_images/mj.JPG', 'link' => 'http://mj.cis.fiu.edu/#login', 'label' => 'Mobile Judge', 'caption' => 'Mobile application which allows senior project judges to provide student evaluations.'),
                    array('image' => '/JobFair/images/spt_images/spw.JPG', 'link' => 'http://spws.cis.fiu.edu/', 'label' => 'Senior Project Website', 'caption' => 'An important tool allowing users to propose mew projects, and explore/join ongoing projects.'),
                ),
                'htmlOptions' => array('style'=>'width: 800px'),
            ));
            $this->endWidget();
                     
        ?>
 </div>

<div style="float:right; width:400px; margin-top: 300px">
    
    <div style="background-color: #E0E0E0 ; border-radius: 5px; border: 20px #E0E0E0; "> 
    <h4 style="text-align: center;"> Full List of Senior Project Sites </h4>
    <div style="margin-left: 15px">
    <?php
    
    foreach($sites as $s)
            {
                echo TbHtml::linkbutton($s['name'],
                array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'size' => TbHtml::BUTTON_SIZE_LARGE, 'url' => $s['url']));
                echo '<br><br>';
            }
    ?>
    </div>
</div>

</div>
