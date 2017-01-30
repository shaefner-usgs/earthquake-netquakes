<?php

if (!isset($TEMPLATE)) {
  $TITLE = 'NetQuakes';
  $NAVIGATION = true;
  $HEAD = '<link rel="stylesheet" href="css/index.css" />';
  $FOOT = '';

  include 'template.inc.php';
}

?>

<figure class="right">
  <img src="netquakes/img/JHamilton.jpg" alt="Photo of John Hamilton" />
  <figcaption>John Hamilton, USGS Scientist, installs a NetQuakes
    instrument at the San Jose Earthquakes Stadium. Photo by
    Scott Haefner, USGS.
  </figcaption>
</figure>

<p>The USGS is trying to achieve a denser and more uniform spacing of
  seismographs in select urban areas to provide better measurements of ground
  motion during earthquakes. These measurements improve our ability to make
  rapid post-earthquake assessments of expected damage and contribute to the
  continuing development of engineering standards for construction.</p>

<p>To accomplish this, we developed a new type of digital seismograph that
  communicates its data to the USGS via the internet. The seismographs connect
  to a local network via WiFi and use existing broadband connections to transmit
  data after an earthquake. The instruments are designed to be installed in
  private homes, businesses, public buildings and schools with an existing
  broadband connection to the internet.</p>

<h2>View Data</h2>

<p>The most recent <a href="netquakes/viewdata">triggered activity at each
  seismograph</a> is available online.</p>

<h2>Sign Up</h2>

<p>Currently, we are unable to purchase additional instruments,
  so we don&rsquo;t anticipate performing many new installations.
  However, if you&rsquo;d like to host a seismograph, we will continue
  <a href="netquakes/signup">collecting names and addresses</a> so that if more
  become available, we will be able to place them in the most effective
  locations.</p>

<p>The NetQuakes seismographs access the internet via a wireless router
  connected to your existing broadband internet connection. The seismograph
  transmits data only after earthquakes greater than magnitude 3 and otherwise
  does not consume significant bandwidth.</p>

<h2>FAQ</h2>

<p><a href="netquakes/faq.php">Frequently Asked Questions</a></p>
