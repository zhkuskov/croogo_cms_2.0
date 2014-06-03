<?php
$vid = $this->requestAction(array('plugin' => 'videos', 'controller' => 'videos', 'action' => 'getvideo'), array('pass' => array('slug' => $slug)));

$bc = '<div style="display:none">

    </div>

    <script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>

    <object id="myExperience '.$vid['Video']['videourl'].'" class="BrightcoveExperience">
        <param name="bgcolor" value="#FFFFFF" />
        <param name="width" value="480" />
        <param name="height" value="270" />
        <param name="playerID" value="'.$vid['Videoplayer']['brightcoveplayerid'].'" />
        <param name="playerKey" value="'.$vid['Videoplayer']['playerkey'].'" />
        <param name="isVid" value="true" />
        <param name="isUI" value="true" />
        <param name="dynamicStreaming" value="true" />

        <param name="@videoPlayer" value="'.$vid['Video']['videourl'].'" />
    </object>

    <script type="text/javascript">brightcove.createExperiences();</script>';

if ($vid['Videoplayer']['title'] == 'Youtube' || $vid['Videoplayer']['title'] == 'Vimeo')
{
    echo $this->Video->embed($vid['Video']['videourl'], array(
        'width' => 450,
        'height' => 300,
        'allowfullscreen'=>1,
        'loop'=>1,
        'color'=>'00adef',
        'show_title'=>1,
        'show_byline'=>1,
        'show_portrait'=>0,
        'autoplay'=>0,
        'frameborder'=>0
    ));
}

else
{
    echo $bc;
}
