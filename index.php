<!DOCTYPE html>
<html>
<head>
    <title>Simulasi Kemahiran Juned</title>
</head>
<body>
    <h2>Simulasi Pertandingan Juned</h2>
    <form method="post">
        <label>Jumlah Lawan (N):</label><br>
        <input type="number" name="n" required><br><br>

        <label>Tingkat Kemahiran Awal Juned (M):</label><br>
        <input type="number" name="m" required><br><br>

        <label>Daftar Tingkat Kemahiran Lawan (A) - pisahkan dengan spasi:</label><br>
        <input type="text" name="a" placeholder="contoh: 8 9 3 2" required><br><br>

        <label>Daftar Tambahan Skill Jika Menang (B) - pisahkan dengan spasi:</label><br>
        <input type="text" name="b" placeholder="contoh: 5 4 1 3" required><br><br>

        <button type="submit">Hitung</button>
    </form>

    <?php
    error_reporting(0);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $n = intval($_POST["n"]);
        $m = intval($_POST["m"]);
        $a = array_map('intval', explode(" ", trim($_POST["a"])));
        $b = array_map('intval', explode(" ", trim($_POST["b"])));

       

        function getMaxSkillLevel($n, $m, $a, $b) {
            //tampung array

            // skill juned & boost = lawan juned
            $opponents = [];

            // data inputan 2 dan 3 di foreach dimasukan menjadi array 
            for ($i = 0; $i < $n; $i++) {
                $opponents[] = ['skill' => $a[$i], 'boost' => $b[$i]];
            }

           
            
        

            //kemudian keduanya datanya di unsort 
            usort($opponents, function ($x, $y) {
                if ($x['skill'] == $y['skill']) {
                    return $y['boost'] - $x['boost'];
                }
                return $x['skill'] - $y['skill'];
            });

            //menghasilkan data variable opponents

            // echo "<pre>";
            // print_r($opponents);


      
            //kemudain datanya di lgoci kan data skill si juned dan lawan nya . 
            foreach ($opponents as $opponent) {
                if ($m >= $opponent['skill']) {
                    $m += $opponent['boost'];
                }
            }

            //menghasilkan data tingkat kemahairan si juned

            return $m;
        }

        $hasil = getMaxSkillLevel($n, $m, $a, $b);
        echo "<h3>Hasil: Tingkat kemahiran maksimal Juned adalah <strong>$hasil</strong></h3>";
    }
    ?>
</body>
</html>