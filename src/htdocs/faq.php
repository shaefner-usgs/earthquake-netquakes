<?php

if (!isset($TEMPLATE)) {
  $TITLE = 'NetQuakes Frequently Asked Questions';
  $HEAD = '<link rel="stylesheet" href="css/faq.css" />';
  $FOOT = '';

  include 'template.inc.php';
}

?>

<ul class="no-style">
  <li>
    <h3>General</h3>
    <ul>
      <li><a href="#whymore">Why do seismologists need to deploy more seismographs?</a></li>
    </ul>
  </li>
  <li>
    <h3>Signing Up</h3>
    <ul>
      <li><a href="#owner">Can renters host a NetQuakes seismograph?</a></li>
      <li><a href="#pay">Will the USGS pay me to host a NetQuakes seismograph?</a></li>
      <li><a href="#forms">Are there any forms to sign?</a></li>
      <li><a href="#inside">My house is just inside one of the polygons. Are you sure I'm ineligible to host a seismograph?</a></li>
      <li><a href="#future">I wasn't selected to host a NetQuakes site, but I still want to host an seismograph. Will there be future opportunities?</a></li>
    </ul>
  </li>
  <li>
    <h3>Installation</h3>
    <ul>
      <li><a href="#looks">How big is a NetQuakes seismograph and what does it look like?</a> </li>
      <li><a href="#power">How much power does the NetQuakes seismograph use?</a> </li>
      <li><a href="#siting">Where do you prefer to install the NetQuakes seismograph?</a></li>
      <li><a href="#install">What is involved in installing the seismograph?</a></li>
      <li><a href="#howlong">How long will it take for the technician to install the instrument?</a></li>
      <li><a href="#whybolt">Why do you need to bolt the instrument to the floor?</a></li>
    </ul>
  </li>
  <li>
    <h3>Triggering</h3>
    <ul>
      <li><a href="#howbig">How big does an earthquake need to be to trigger the instrument?</a></li>
      <li><a href="#accident">Will I create an &ldquo;earthquake&rdquo; if I accidentally bump the seismograph or if it triggers when I move my car in and out of the garage?</a></li>
    </ul>
  </li>
  <li>
    <h3>Data &amp; Transmission</h3>
    <ul>
      <li><a href="#datasite">Where can I see the data recorded by my NetQuakes seismograph?</a></li>
      <li><a href="#datause">What will the USGS do with the earthquake data from the NetQuakes seismograph?</a></li>
      <li><a href="#myrouter">How does the NetQuakes seismograph access the Internet?</a></li>
      <li><a href="#access">Can the USGS access my home computer?</a></li>
      <li><a href="#upload">How long does it take for the NetQuakes seismograph to transmit an earthquake record to the USGS?</a></li>
      <li><a href="#powerout">What happens to the seismic data if the power goes out during an earthquake?</a></li>
      <li><a href="#noInternet">What happens if my Internet connection is unavailable?</a></li>
    </ul>
  </li>
  <li>
    <h3>Service &amp; Maintenance</h3>
    <ul>
      <li><a href="#working">How do I know that the NetQuakes seismograph is working?</a></li>
      <li><a href="#health">How does the USGS know that the seismograph is functioning properly?</a></li>
      <li><a href="#skills">What kind of skills do I need to service a NetQuakes seismograph?</a></li>
      <li><a href="#moving">I am moving. What do I do with the NetQuakes seismograph?</a></li>
      <li><a href="#newISP">I am changing Internet Service Providers. Will that require changing anything in the NetQuakes seismograph?</a></li>
    </ul>
  </li>
</ul>

<h2>General</h2>

<a name="whymore" id="whymore"></a><h4>
Why do seismologists need to deploy more seismographs?
</h4>
<p>
Records of earthquake ground motion close to large earthquakes are used by the engineers
to develop methods to construct buildings that do not collapse during earthquakes.
These recordings can also be used to understand why engineered structures
(buildings, bridges, overpasses, pipelines) fail during earthquakes
if the instrument is located close to the structure.
These recordings are quite rare, particularly in dense urban areas.
Unfortunately, the San Francisco Bay area is home to
<a href="https://pubs.er.usgs.gov/publication/fs20163020/">several large faults</a>,
but this situation is ideal for recording strong shaking near engineered structures.
</p>


<h2>Signing Up</h2>

<a name="owner" id="owner"></a><h4>
 Can renters host a NetQuakes seismograph?
</h4>
<p>
Yes, as long as the owner of the property does not object to the small hole we must drill to secure the baseplate of the seismograph.
The owner of the property will have to sign the <a href="docs/Revocable_Permit.pdf">Permit Agreement</a>.
</p>

<a name="pay" id="pay"></a><h4>
Will the USGS pay me to host a NetQuakes seismograph?
</h4>
<p>
No. We are looking for volunteers.
</p>

<a name="forms" id="forms"></a><h4>
Are there any forms to sign?
</h4>
<p>
You will be asked to sign an agreement that describes your responsibilities and those of the USGS.
You can view it <a href="docs/Revocable_Permit.pdf">here</a>.
</p>

<a name="inside" id="inside"></a><h4>
My house is just inside one of the polygons. Are you sure I'm ineligible
to host a seismograph?
</h4>
<p>
The polygons are only for guidance, so please submit an application.
</p>

<a name="future" id="future"></a><h4>
I wasn't selected to host a NetQuakes site, but I still want to host an seismograph. Will there be future opportunities?
</h4>
<p>
We appreciate your willingness to host a seismograph and regret that we
don't have sufficient funding to install seismographs at the locations of all
applicants. We hope to install more seismographs next year, and we will keep
your application on file.
</p>


<h2>Installation</h2>

<a name="looks" id="looks"></a><h4>
How big is a NetQuakes seismograph and what does it look like?
</h4>
<figure class="right">
  <img src="img/NetQuakes.jpg" alt="NetQuakes instrument" />
</figure>
<p>The seismograph has dimensions of approximately width=5.5", height=6.5", and length=11.5".</p>

<a name="power" id="power"></a><h4>
How much power does the NetQuakes seismograph use?
</h4>
<p>
Approximately 3 watts.
At typical residential electricity rates of $0.12/kWh, this costs ~$0.26/month
</p>

<a name="siting" id="siting"></a><h4>
Where do you prefer to install the NetQuakes seismograph?
</h4>
<p>
The seismograph is a sensitive instrument and therefore should be located where there is as little ambient noise as possible. Garages or basements with concrete slabs are ideal. Locations next to pool pumps or air conditioners are undesireable because the earthquake signal will be contaminated by this noise. If the seismograph is located where there is frequent foot or vehicle traffic, it may trigger repeatedly on non-earthquake signals.
</p>

<a name="install" id="install"></a><h4>
What is involved in installing the seismograph?
</h4>
<p>
The technician and you will agree on a mutually acceptable location to site the instrument.
The technician will install the WiFi router, drill a 1/2" hole in the concrete floor,
orient the baseplate of the seismograph to point north,
bolt the baseplate to the floor, and confirm that the
seismograph is both functional and has Internet connectivity.
If using wireless, the seismograph will need to be located within about 120 feet of the
wireless router.
</p>

<a name="howlong" id="howlong"></a><h4>
How long will it take for the technician to install the instrument?
</h4>
<p>
We estimate 2 hours.
</p>

<a name="whybolt" id="whybolt"></a><h4>
Why do you need to bolt the seismograph to the floor?
</h4>
<p>
We want the seismograph to faithfully record strong shaking.
If the seismograph slides across the floor or bounces off the ground, then the data are useless.   Should we permanently remove the seismograph, we will remove the bolt and fill the small hole.
</p>


<h2>Triggering</h2>

<a name="howbig" id="howbig"></a><h4>
How big does an earthquake need to be to trigger the seismograph?
</h4>
<figure class="right">
  <img src="img/ba_pga_vs_r.gif" alt="seismograph triggers" />
</figure>
<p>
The seismograph will trigger if the acceleration is greater than 0.25% of the earth's gravity on the horizontal sensors.
The plot below shows that the seismograph should trigger for earthquakes of magnitude(M)>4 if within 60 km (37 miles) and M>5 at twice that distance. It is common for the seismograph to trigger on quakes as small as magnitude 3 within distances of a few 10's of km.
</p>

<p>For more background on how seismic energy attenuates, visit the &ldquo;<a href="http://peer.berkeley.edu/products/nga_project.html">Next Generation of Ground-Motion Attenuation Models</a>&rdquo; Project.</p>

<a name="accident" id="accident"></a><h4>
Will I create an &ldquo;earthquake&rdquo; if I accidentally bump the seismograph or
if it triggers when I move my car in and out of the garage?
</h4>
<p>
The instrument will trigger if the acceleration is greater than 0.25% of the earth's gravity.
It will transmit the data to the USGS, but unless there is a real earthquake at the same time,
the data will be ignored but still visible to you on the Web site.
</p>


<h2>Data &amp; Transmission</h2>

<a name="datasite" id="datasite"></a><h4>
Where can I see the data recorded by my NetQuakes seismograph?
</h4>
<p>
Images of the previous 30 days of triggered accelerograms from your instrument are available under <a href="map/">View Data</a> on this web site.
</p>

<a name="datause" id="datause"></a><h4>
What will the USGS do with the earthquake data from the NetQuakes seismograph?
</h4>
<p>
Real-time software will automatically incorporate the data for computing <a href="http://earthquake.usgs.gov/earthquakes/shakemap/">ShakeMaps</a>,
improving earthquake locations and magnitudes, and determining the fault orientation.
If the magnitude is greater than about 5, we will also use the seismograms to calculate the amount of fault displacement that occurred during
the earthquake.
The earthquake data will be quickly archived at public datacenters for use by seismologists and engineers.
Noise triggers will be discarded.
</p>

<a name="myrouter" id="myrouter"></a><h4>
How does the NetQuakes seismograph access the Internet?
</h4>
<p>
Most hosts will probably prefer that the NetQuakes seismograph connect to the Internet using
wireless networking to a WiFI home router using 802.11b or 802.11g,
but it does support connection via an Ethernet cable.
To minimize the time USGS technicians spend installing the NetQuakes seismograph, we prefer
to provide you with a WiFi router that we know works with the NetQuakes seismograph.
You will be given the security key so you can use the router.
If we can configure the NetQuakes seismograph to successfully connect to the Internet using
your wireless router, we will be happy to use your equipment.
If using wireless, the seismograph will need to be located within about 120 feet of the
wireless router.</p>

<a name="access" id="access"></a><h4>
Can the USGS access my home computer?
</h4>
<p>
No. Your computer is behind your LAN's firewall and therefore the USGS cannot access your LAN.
If we install a WiFi router, we will provide you with administrator passwords on the WiFi router so that you can confirm
that the firewall settings of the router are secure.
</p>

<a name="upload" id="upload"></a><h4>
How long does it take for the NetQuakes seismograph to transmit an earthquake record to the USGS?
</h4>
<p>
About 1 minute.
</p>

<a name="powerout" id="powerout"></a><h4>
What happens to the seismic data if the power goes out during an earthquake?
</h4>
<p>
The seismograph will run on internal batteries for about 36 hours.
When the battery voltage drops below the required level, the seismograph goes into sleep mode.
When it senses the availability of A/C power, it will restart, send data files to the USGS
if there is Internet connectivity, and synchronize timing.
</p>

<a name="noInternet" id="noInternet"></a><h4>
What happens if my Internet connection is unavailable?
</h4>
<p>
It will keep trying to connect forever.
</p>


<h2>Service &amp; Maintenance</h2>

<a name="working" id="working"></a><h4>
How do I know that the NetQuakes seismograph is working?
</h4>
<p>
You can trigger the instrument by gently bumping the instrument so that it triggers.
The tiny yellow LED labeled &ldquo;event&rdquo; will light for ~1-2 minutes indicating that data are being recorded.
Then, the blue LED labeled &ldquo;link&rdquo; will light briefly indicating that communications have been
established with one of the servers and the data are being uploaded.
In a few minutes an image of the accelerograms from your instrument will appear
on <a href="map/">this web site</a>.
If the instrument is malfunctioning, the USGS will notify you about replacing it.
</p>

<a name="health" id="health"></a><h4>
How does the USGS know that the seismograph is functioning properly?
</h4>
<p>
At the beginning of each day, the seismograph will call our servers and send the previous day's computer log.
This is a record of each action the seismograph has taken.
Once a day, the sensor and record electronics are tested with a calibration signal.
At regular intervals, usually once an hour, a short state-of-health message is sent with information about
the internal batteries, memory usage, temperature, etc.
</p>

<a name="skills" id="skills"></a><h4>
What kind of skills do I need to service a NetQuakes seismograph?
</h4>
<p>
A hexdriver (provided) is all that is needed to remove the screws securing the seismograph lid
and the seismograph from the baseplate.
Servicing will be limited to changing the battery approximately every 3 years, or swapping the
entire seismograph if the USGS detects that is malfunctioning.
Instructions will also be enclosed with anything we send you, as will business-reply packaging
to return the old batteries or seismograph to us free of charge.
</p>

<a name="moving" id="moving"></a><h4>
I am moving. What do I do with the NetQuakes seismograph?
</h4>
<p>
Please <a href="/contactus/?to=jbrody">contact us</a>  and we will arrange to remove the seismograph.
If the new owner desires to keep it operating, please ask them to contact us to make new WiFi and other arrangements.
</p>

<a name="newISP" id="newISP"></a><h4>
I am changing Internet Service Providers. Will that require changing anything in the NetQuakes seismograph?
</h4>
<p>
No.
</p>
