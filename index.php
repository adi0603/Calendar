<?php
  session_start();
  $monthlist=array("JANUARY","FEBRUARY","MARCH","APRIL","MAY","JUNE","JULY","AUGUST","SEPTEMBER","OCTOBER","NOVEMBER","DECEMBER");
  $weeklist=array("SUN","MON","TUE","WED","THU","FRI","SAT");
  $friend=array("Gaurav","Isha","Aditya","Test");
  $friendDate=array(13,4,21,15);
  $friendMonth=array(10,2,4,10);
  if(function_exists('date_default_timezone_set')) {
    date_default_timezone_set("Asia/Kolkata");
  }
  $storeYear=0;
  $storeMonth=0;
  $today=1;
  $currentDay=date("d");
  $found=false;
  if($today==1)
  {
    $storeYear=date("Y");
    $storeMonth=date("m");
    $today++;
  }
  if(isset($_POST['previous']))
  {
    if($storeMonth==1)
    {
      $storeMonth=12;
      $storeYear=$storeYear-1;
    }
    else
    {
      $storeMonth=$storeMonth-1;
    }
    showDay($storeMonth,$storeYear);
  }
  if(isset($_POST['next'])) 
  {
    if($storeMonth==12)
    {
      $storeMonth=1;
      $storeYear=$storeYear+1;
    }
    else
    {
      $storeMonth=$storeMonth+1;
    }
    showDay($storeMonth,$storeYear);
  }
   
  if(isset($_POST['search'])) 
  {
    $storeYear1 = $_POST['enteryear'];
    if($storeYear1<=0)
    {
      $found = true;
    }
    else
    {
      $storeYear=$_POST['enteryear'];
      $storemonth1 = $_POST['entermonth'];
      $storeMonth=$storemonth1+1;
    }
  }
  $day=showDay($storeMonth,$storeYear);

  /*_____________showDay function_________________*/
  function showDay($m,$y)
  {
    $d=1;
    $odd_day=0;
    $ar=array(31,$y%100==0?$y%400==0?29:28:$y%4==0?29:28,31,30,31,30,31,31,30,31,30,31);
    if($y>0)
    {
      $y1=$y-1;
      $sum=0;
      $y1=$y1%400;
      if($y1>=300)
        {
          $sum=$sum+1;
        }
        $y1=$y1%300;
        if($y1>=200)
        {
          $sum=$sum+3;
        }
        $y1=$y1%200;
        if($y1>=100)
        {
          $sum=$sum+5;
        }
        $y1=$y1%100;
        $lp=(int)($y1/4);
        $sum=$sum+($lp*2);
        $sum=$sum+($y1-$lp);
        for($x=1;$x<$m;$x++)
        {
          $sum=$sum+findOdd($x,$y);
        }
        $sum=$sum+$d;
        $odd_day=$sum%7;
        return $odd_day;
      }
    }
  function findOdd($m, $y)
  {
    $ar=array(3,$y%100==0?$y%400==0?1:0:$y%4==0?1:0,3,2,3,2,3,3,2,3,2,3);
    return $ar[$m-1];
  }

?>
<html>
  <head>
    <link rel = "icon" type = "image/png" href = "image/logo.png">
    <title>Calendar</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <script src="https://kit.fontawesome.com/ab99e84824.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
   
  </head>
  <body>
  

    <script type="text/javascript">
      var r = confirm("Happy Diwali!\nDo You want to see FireWork");
  if (r == true) {
    window.location.href='index.html'
  } 
    </script>

    
    <div class="wrapper">
      <header class="page-header">
        <nav>
          <h2 class="logo">Calendar</h2>
          <ul>
            <li>
              <a href="index.php">Home</a>
            </li>
            <li>
              <a href="about.html">About</a>
            </li>
          </ul>
          <button class="cta-contact">Contact Us</button>
        </nav>
      </header>
      
      <main class="page-main">
        <div class="container">
          <form action="" method="post">
          <table>
             <caption><?php echo $monthlist[$storeMonth-1]."\t".$storeYear;?></caption>
            <thead>
              <tr>
                <th scope="col">SUN</th>
                <th scope="col">MON</th>
                <th scope="col">TUE</th>
                <th scope="col">WED</th>
                <th scope="col">THU</th>
                <th scope="col">FRI</th>
                <th scope="col">SAT</th>
              </tr>
            </thead>

            <tbody>
            <?php
              $ar=array(31,$storeYear%100==0?$storeYear%400==0?29:28:$storeYear%4==0?29:28,31,30,31,30,31,31,30,31,30,31);
              $wcount=0;
              $cweek=0;
              $count=1;
              $run=1;
              while(true)
              {
                ?>
                <?php
                if($cweek==0)
                {
                  ?>
                  <tr>
                  <?php
                }
                $cweek++;
                if($run<$day+1)
                {
                  if($storeMonth==1)
                  {
                    $blank=($ar[11]+$run-$day);
                  }
                  else
                  {
                    $blank=($ar[$storeMonth-2]+$run-$day);
                  }
                  ?>
                  <td data-label="<?php echo $weeklist[$cweek-1];?>" style="color: #D1CDCD"><?echo $blank;?></td>
                  <?php
                }
                elseif($cweek<=7)
                {
                  // $presentDay="#76ACE2";
                  $holiday="#F73434";
                  if($count==$currentDay && $storeYear==date("Y") && $storeMonth==date("m"))
                  {
                    ?>
                    <td bgcolor="#76ACE2" data-label="<?php echo $weeklist[$cweek-1];?>" ><?echo $count;?></td>
                    <?php
                  }
                  else
                  {
                    if(($count>=26 && $count<=28) && ($storeMonth==10) )
                    {
                      ?>
                          <td title="Deepawali" bgcolor="<?php echo $holiday;?>" data-label="<?php echo $weeklist[$cweek-1];?>" ><?echo $count;?></td>
                    <?php
                    }
                    else
                    {
                      ?>
                      <td  data-label="<?php echo $weeklist[$cweek-1];?>" ><?echo $count;?></td>
                      <?php
                    }
                  }
                    $count++;
                  
                }
                else
                {
                    $cweek=0;
                    $wcount++;
                    ?>
                    </tr>
                    <?php
                }
                if($count>$ar[$storeMonth-1])
                {
                    $new=$cweek;
                    for($i=1;$i<=(7-$new);$i++)
                    {
                      $cweek++;
                      ?>
                      <td data-label="<?php echo $weeklist[$cweek-1];?>" style="color: #D1CDCD"><?echo $i;?></td>
                    <?php
                    }
                    ?>
                  </tr>
                  <?php
                    break;
                }
                $run++;
              }?>

              <tr>
                 <!-- <th colspan="2"><div class="month"><input type="submit" name="previous" value="Previous" disabled=""></div></th>  -->
                <td data-label="Select Month" colspan="3"><div class="selectmonth">
                  <select name="entermonth">
                    <option value="0">JANUARY</option>
                    <option value="1">FEBRUARY</option>
                    <option value="2">MARCH</option>
                    <option value="3">APRIL</option>
                    <option value="4">MAY</option>
                    <option value="5">JUNE</option>
                    <option value="6">JULY</option>
                    <option value="7">AUGUST</option>
                    <option value="8">SEPTEMBER</option>
                    <option value="9">OCTOBER</option>
                    <option value="10">NOVEMBER</option>
                    <option value="11">DECEMBER</option>
                  </select>
                </div></td>
                <td data-label="Enter Year">
                  <div class="textbox">
                    <input type='number' name="enteryear" placeholder="Year" class='nice' min="1" required>
                  </div>
                </td>
                <td data-label="Press Search" colspan="3"><div class="month">
                  <?php $_SESSION['storeToday']=$today;?>
                  <input type="submit" name="search" value="Search">
                  <input type="hidden" id="storeToday" name="storeToday" value="<?php echo $_SESSION['storeToday'];?>">
                  </div>
                </td>
                 <!-- <th colspan="2"><div class="month"><input type="submit" name="next" value="Next" disabled=""></div></th>  -->
              </tr>

            </tbody>
            </form>
          </table>
          <?php echo "You search $storeMonth, $storeYear";?>
        </div>
      </main>
      <footer class="page-footer">
        <small>&copy; Copyright 2019. All rights reserved.</small>
        <ul>
          <li>
            <a href="https://www.instagram.com/_simplethoughts._/?igshid=k93qpcqslcgk" target="_blank"><i class="fab fa-instagram"></i></a>
          </li>
          <li>
            <a href="https://www.linkedin.com/in/aditya-pandey-1375a818a/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
          </li>
          <li>
            <a href="https://github.com/adi0603" target="_blank"><i class="fab fa-github"></i></i></a>
          </li>
          <li>
            <a href="https://www.hackerrank.com/adi_pandey" target="_blank"><i class="fab fa-hackerrank"></i></a>
          </li>
        </ul>
      </footer>
    </div>
  </body>
</html>