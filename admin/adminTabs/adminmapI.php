  <?php
session_start();
if ($_SESSION["isAdmin"] == false){
	header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index.html');
}
?>
<html>
<head>
<<<<<<< HEAD:admin/adminTabs/adminmapI.php
=======

>>>>>>> 7348fd6f5f0f4c74204abd078d292b0aba3da4bf:admin/adminTabs/adminmap.html
</head>
<div class="container">
  <div style="text-align:center">
	<form action="./adminTabs/adminmap.php" method="GET" id = "form">
    Please choose time period (Default: All) <div id="mobile"><h1>         </h1></div>
  <select name="monthsince" id="monthsince">
    <option value="">Since (Month) </option>
    <option value="01">Ιανουάριος</option>
    <option value="02">Φεβρουάριος</option>
    <option value="03">Μάρτιος</option>
    <option value="04">Απρίλιος</option>
    <option value="05">Μάιος</option>
    <option value="06">Ιούνιος</option>
    <option value="07">Ιούλιος</option>
    <option value="08">Αύγουστος</option>
    <option value="09">Σεπτέμβριος</option>
    <option value="10">Οκτώβριος</option>
    <option value="11">Νοέμβριος</option>
    <option value="12">Δεκέμβριος</option>
  </select>
  <select name="monthuntil" id="monthuntil">
    <option value="">Until (Month) </option>
    <option value="01">Ιανουάριος</option>
    <option value="02">Φεβρουάριος</option>
    <option value="03">Μάρτιος</option>
    <option value="04">Απρίλιος</option>
    <option value="05">Μάιος</option>
    <option value="06">Ιούνιος</option>
    <option value="07">Ιούλιος</option>
    <option value="08">Αύγουστος</option>
    <option value="09">Σεπτέμβριος</option>
    <option value="10">Οκτώβριος</option>
    <option value="11">Νοέμβριος</option>
    <option value="12">Δεκέμβριος</option>
  </select>
  <select name="yearsince" id="yearsince">
    <option value="">Since (Year) </option>
<<<<<<< HEAD:admin/adminTabs/adminmapI.php
    <option value="2015">2015</option>
=======
    <option value="2015">2010</option>
>>>>>>> 7348fd6f5f0f4c74204abd078d292b0aba3da4bf:admin/adminTabs/adminmap.html
    <option value="2016">2016</option>
    <option value="2017">2017</option>
    <option value="2018">2018</option>
    <option value="2019">2019</option>
    <option value="2020">2020</option>
    <option value="2021">2021</option>
    <option value="2022">2022</option>
    <option value="2023">2023</option>
    <option value="2024">2024</option>
    <option value="2025">2025</option>
  </select>
    <select name="yearuntil" id="yearuntil" >
      <option value="">Until (Year) </option>
      <option value="2015">2015</option>
      <option value="2016">2016</option>
      <option value="2017">2017</option>
      <option value="2018">2018</option>
      <option value="2019">2019</option>
      <option value="2020">2020</option>
      <option value="2021">2021</option>
      <option value="2022">2022</option>
      <option value="2023">2023</option>
      <option value="2024">2024</option>
      <option value="2025">2025</option>
    </select>
    <select name="daysince" id="daysince">
        <option value="">Since (Day) </option>
        <option value="02">Monday</option>
        <option value="03">Tuesday</option>
        <option value="04">Wednesday</option>
        <option value="05">Thursday</option>
        <option value="06">Friday</option>
        <option value="07">Saturday</option>
        <option value="01">Sunday</option>
      </select>
      <select name="dayuntil" id="dayuntil" >
        <option value="">Until (Day) </option>
        <option value="02">Monday</option>
        <option value="03">Tuesday</option>
        <option value="04">Wednesday</option>
        <option value="05">Thursday</option>
        <option value="06">Friday</option>
        <option value="07">Saturday</option>
        <option value="01">Sunday</option>
      </select>
      <select name="hoursince" id="hoursince" >
        <option value="">Since (Hour) </option>
        <option value="01">00:00</option>
        <option value="02">01:00</option>
        <option value="03">02:00</option>
        <option value="04">03:00</option>
        <option value="05">04:00</option>
        <option value="06">05:00</option>
        <option value="07">06:00</option>
        <option value="08">07:00</option>
        <option value="09">08:00</option>
        <option value="10">09:00</option>
        <option value="11">10:00</option>
        <option value="12">11:00</option>
        <option value="13">12:00</option>
        <option value="14">13:00</option>
        <option value="15">14:00</option>
        <option value="16">15:00</option>
        <option value="17">16:00</option>
        <option value="18">17:00</option>
        <option value="19">18:00</option>
        <option value="20">19:00</option>
        <option value="21">20:00</option>
        <option value="22">21:00</option>
        <option value="23">22:00</option>
        <option value="24">23:00</option>
      </select>
      <select name="houruntil" id="houruntil">
      <option value="">Until (Hour) </option>
      <option value="01">00:00</option>
      <option value="02">01:00</option>
      <option value="03">02:00</option>
      <option value="04">03:00</option>
      <option value="05">04:00</option>
      <option value="06">05:00</option>
      <option value="07">06:00</option>
      <option value="08">07:00</option>
      <option value="09">08:00</option>
      <option value="10">09:00</option>
      <option value="11">10:00</option>
      <option value="12">11:00</option>
      <option value="13">12:00</option>
      <option value="14">13:00</option>
      <option value="15">14:00</option>
      <option value="16">15:00</option>
      <option value="17">16:00</option>
      <option value="18">17:00</option>
      <option value="19">18:00</option>
      <option value="20">19:00</option>
      <option value="21">20:00</option>
      <option value="22">21:00</option>
      <option value="23">22:00</option>
      <option value="24">23:00</option>
    </select>
    <select name="types[]" id="types" multiple>


    </select>
    <script>

    </script>

<input type="submit" id="submittypes" > 
</form>
</div>
</div>
  <div id="map1" style="height:700px; width:100%"></div>
</div>
<script src="./adminTabs/getlocationtypes.js" defer></script>
<script src="./adminTabs/adminmap.js" defer></script>
</body>
</html>

