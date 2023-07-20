<?php
require_once './dashboard-include.php';
?>
        <div class="rewards-container">
            <?php
                $costs = [50, 100, 200];
                for ($i=0; $i<3; $i++) {
                    ?>
                    <div>
                        <img src="reward-$i.png" <?php 
                            if ($costs[$i] > $result['rewardPoints']) 
                                echo 'class = "grayscale"'; ?>>
                        <!-- in css, just use filter: saturate(0);-->
                        <span>Recycled paper</span>
                        <span>Cost: <?=$costs[$i]?></span>
                    </div>
                    <?php
                }
            ?>
        </div>

        <div>
            <h3>Nearby Recycling Stations</h3>
            <ul>
                <li><h4>Station 1</h4>
                    <span>Koteshwor, Kathmandu</span>
                    <span>near Police Staion</span>
                </li>
                <li><h4>Station 2</h4>
                    <span>Chyasal, Lalitpur</span>
                    <span>near ANFA football ground</span>
                </li>
                <li><h4>Station 3</h4>
                    <span>Singha Durbar</span>
                    <span>beside NTC office</span>
                </li>
            </ul>
        </div>
    </body>
</html>
