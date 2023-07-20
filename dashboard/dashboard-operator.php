<?php
require_once './dashboard-include.php';
?>
        <div>
            <button id="btnRecordRecycle">
                <span>Record a recycle event</span>
                <img src="">
            </button>

            <button id="btnRecordRedeem">
                <span>Record a redeem event</span>
                <img src="">
            </button>
        </div>

        <dialog id="dialogRecycle">
            <form method="post">
                <select name="userId" required>User:
                    <?php 
                        $usersSql = 'select userId, fName from users where userType = "normal"';
                        $usersStatement = $pdo->query($usersSql);
                        while ($usersResult = $usersStatement->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='".$usersResult['userId']."'>{$usersResult['fName']}</option>";
                        }
                    ?>
                </select>

                <select name="recycleCategoryId" required>Recycle Category:
                    <?php
                        $recyclesql = 'select * from recycleCategory';
                        $recycleStatement = $pdo->query($recyclesql);
                        while($categoryResult = $recycleStatement->fetch(PDO::FETCH_ASSOC)) {
                             echo "<option value='".$categoryResult['categoryId']."'>{$categoryResult['categoryName']}</option>";
                        }
                    ?>
                </select>

                <label>Points Awarded: <input type="number" min="0" name="pointsAwarded" required></label>
                <label>Description:<textarea name="description"></textarea></label>
                <button name="submitRecycle" id="submitRecycle">Submit</button>
            </form>
            <button type="button" id="cancelRecycle">Cancel</button>
        </dialog>

        <dialog id="dialogRedeem">
            <form method="post">
                <select name="userId" required>User:
                    <?php 
                        $usersStatement = $pdo->query($usersSql);
                        while ($usersResult = $usersStatement->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='".$usersResult['userId']."'>{$usersResult['fName']}</option>";
                        }
                    ?>
                </select>
                <label>Points Spent: <input type="number" min="0" name="pointsSpent" required></label>
                <button name="submitRedeem" id="submitRedeem">Submit</button>
            </form>
            <button type="button" id="cancelRedeem">Cancel</button>
        </dialog>

        <script>
            const recycleDialog = document.querySelector('#dialogRecycle');
            document.querySelector('#btnRecordRecycle').onclick = () => recycleDialog.showModal();
            recycleDialog.querySelector('#cancelRecycle').onclick = () => recycleDialog.close();

            const redeemDialog = document.querySelector('#dialogRedeem');
            document.querySelector('#btnRecordRedeem').onclick = () => redeemDialog.showModal();
            redeemDialog.querySelector('#cancelRedeem').onclick = () => redeemDialog.close();
        </script>

        <?php
            if (isset($_POST['submitRecycle'])) {
                $userId = $_POST['userId'];
                $recycleCategoryId = $_POST['recycleCategoryId'];
                $pointsAwarded = $_POST['pointsAwarded'];
                $description = $_POST['description'];

                $logsSql = "insert into logs(userId, recycleCategoryId, description) values('$userId', '$recycleCategoryId', '$description')";
                $pdo->query($logsSql);

                $increasePointsSql = "update users set `rewardPoints` = `rewardPoints` + '$pointsAwarded' where `userId` = '$userId'";
                $pdo->query($increasePointsSql);
            }

            if (isset($_POST['submitRedeem'])) {
                $userId = $_POST['userId'];
                $pointsSpent = $_POST['pointsSpent'];
                $decreasePointsSql = "update users set `rewardPoints` = `rewardPoints` - '$pointsSpent' where `userId` = '$userId'";
                $pdo->query($decreasePointsSql);
            }
        ?>
    </body>
</html>
