<html>
    <head>
        <title>Whack-a-Mole</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="script/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="script/bootstrap.min.js"></script>
        <script type="text/javascript" src="script/game.js"></script>
    </head>
    <body>
        <div class="container">
            <h1>Whack-a-Mole</h1>
            <div id="game">
                <div id = "hole1" class="hole"></div>
                <div id = "hole2" class="hole"></div>
                <div id = "hole3" class="hole"></div>
                <div id = "hole4" class="hole"></div>
                <div id = "hole5" class="hole"></div>
                <div id = "hole6" class="hole"></div>
                <div id = "hole7" class="hole"></div>
                <div id = "hole8" class="hole"></div>
                <div id = "hole9" class="hole"></div>
            </div>
            <form action="" method="post" name="user" id="userform">
                <input type="text" name="name" required placeholder="Enter your name" value=<?php echo "\"".$name."\"" ?>>
                <input type="text" name="score" required hidden>
                <input type="text" name="mole" required hidden>
                <input type="text" name="mole1" required hidden>
                <input type="text" name="mole2" required hidden>
                <input type="text" name="mole3" required hidden>
                <input type="text" name="mole4" required hidden>
                <input type="text" name="mole5" required hidden>
                <input type="text" name="mole6" required hidden>
                <input type="text" name="mole7" required hidden>
                <input type="text" name="mole8" required hidden>
                <input type="text" name="mole9" required hidden>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            </form>
            <button onclick="startgame();" id="startbutton">START</button>
            <button onclick="stopgame();" id="stopbutton">STOP</button><br>
            <div id='scorebox'>
                <div class="data">Points: <span id ="score"> <?php echo $score ?> </span></div>
                <div class="data">Time: <span id ="time"> 0 </span></div>
            </div>
            <button id="emailbutton" onclick="$('#myModal1').modal();" <?php if(!$post) {echo 'disabled';} ?>>Email Score</button>
            <button id="infobutton" onclick="$('#myModal2').modal();">i</button>
            <button onclick="$('#myModal').modal();" id="historybutton">Show History</button><br>
            <button id="hilightbutton" onclick = <?php echo "\"highlight(".$mole1.",".$mole2.",".$mole3.");\""?>>Highlight top 3 hit moles</button>
            <button id="hilightbutton2" onclick = <?php echo "\"highlight2(".$max.");\""?>>Highlight Mole hit most by top 3 players</button>
        </div>

        <!-- Player Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Top Players</h4>
              </div>
              <div class="modal-body">
                  <table>
                      <tr>
                          <th>Player</th>
                          <th>Score</th>
                          <th>Date</th>
                          <th>Lucky mole</th>
                      </tr>
                      <tr>
                          <td><?php echo $top[0]['name']; ?></td>
                          <td><?php echo $top[0]['score']; ?></td>
                          <td><?php
                                $date1 = new Datetime($top[0]['date']);
                                echo $date1->format('d-m-Y'); ?></td>
                          <td><?php echo $top[0]['mole']; ?></td>
                      </tr>
                      <tr>
                          <td><?php echo $top[1]['name']; ?></td>
                          <td><?php echo $top[1]['score']; ?></td>
                          <td><?php
                                $date2 = new Datetime($top[1]['date']);
                                echo $date2->format('d-m-Y'); ?></td>
                          <td><?php echo $top[1]['mole']; ?></td>
                      </tr>
                      <tr>
                          <td><?php echo $top[2]['name']; ?></td>
                          <td><?php echo $top[2]['score']; ?></td>
                          <td><?php
                                $date3 = new Datetime($top[2]['date']);
                                echo $date3->format('d-m-Y'); ?></td>
                          <td><?php echo $top[2]['mole']; ?></td>
                      </tr>
                  </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Top Players</h4>
              </div>
              <div class="modal-body">
                  <form action="game/email" method="post" name="email" id="emailform">
                      <input type="email" name="email" placeholder="Enter Email">
                      <input type="text" name="name" hidden=""  value=<?php echo "\"".$name."\""?>>
                      <input type="text" name="score"  hidden=""  value=<?php echo "\"".$score."\""?>>
                      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                      <input type="submit" value="Send">
                  </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">About</h4>
              </div>
              <div class="modal-body">
                  <p>This is a game created by Devdhar Patel using the laravel framework.</p>
                  <p>Email : devdharpatel@gmail.com</p>
                  <a href="https://github.com/dee0512/Whack-a-Mole">Github</a>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    </body>
</html>
