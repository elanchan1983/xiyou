<?php

//调用zt.ini是否存在
include("./ini/zt_ini.php");
$bpid=($iniFile->getItem('玩家信息','帮派id'));
if($bpid>=1){
    $uname=($iniFile->getItem('玩家信息','玩家名字'));
    $bpmz=($iniFile->getItem('玩家信息','帮派名字'));
    include("./ini/bp_ini.php");
    $bp=($iniFile->getCategory('国家信息'));
    $xbzmz=$bp['现任君主'];
    $xwjid=$bp['现任君主id'];
    //点击国家权杖合法代码
    $bossid=1;
    include("./ini/boss_ini.php");
    $yjdm1=($iniFile->getItem('世界BOSS属性','血'));
    $bossid=2;
    include("./ini/boss_ini.php");
    $yjdm2=($iniFile->getItem('世界BOSS属性','血'));
    $bossid=3;
    include("./ini/boss_ini.php");
    $yjdm3=($iniFile->getItem('世界BOSS属性','血'));
    $bossid=4;
    include("./ini/boss_ini.php");
    $yjdm4=($iniFile->getItem('世界BOSS属性','血'));
    $bossid=5;
    include("./ini/boss_ini.php");
    $yjdm5=($iniFile->getItem('世界BOSS属性','血'));
    $bossid=6;
    include("./ini/boss_ini.php");
    $yjdm6=($iniFile->getItem('世界BOSS属性','血'));

    $weekarray=array("7","1","2","3","4","5","6");
    $zcid = $weekarray[date("w")];

    include("./ini/gz01_ini.php");
    $zlgjid=($iniFile->getItem('国家id', $zcid));
    $zlgj=($iniFile->getItem('国家名字', $zcid));
    $czz=($iniFile->getItem('夺仗人', $zcid));

    $czzpd=($iniFile->getItem('夺仗人','初始'));//夺仗变量
    //$czzpd=1;
    $czzpd = $czzpd ?? 1;
    if($zlgjid==$bpid||$zlgjid!=$bpid&&$boss1<=0&&$boss2<=0&&$boss3<=0&&$boss4<=0&&$boss5<=0&&$boss6<=0&&$czzpd!=2){
        if($zlgjid!=$bpid){
            include("./ini/gz01_ini.php");
            $iniFile->updItem('夺仗人', ['初始' => '2']);//写入战斗页面
            if($zlgjid!=""){
                $db = DB::instance();
                $db->update('gz01', [
                    'zlgj' => $bpmz, //国家名字
                    'zlgjid' => $bpid, //孤傲家id
                    'gjjz' => $xbzmz, //君主名字
                    'gjjzid' => $xwjid, //君主id
                    'czz' => $uname, //夺杖人
                    'czzid' => $wjid, //夺杖人id
                ], ['zcid' => $zcid]);

                $inina="gz01.ini";
                $path='acher/guoz';
                $file = $path."/".$inina;
                _unlink($file);

                //$iniFile->updItem('国家名字', [$zcid => $bpmz]);
                //$iniFile->updItem('国家id', [$zcid => $bpid]);
                //$iniFile->updItem('君主名字', [$zcid => $xbzmz]);
                //$iniFile->updItem('君主id', [$zcid => $xwjid]);
                //$iniFile->updItem('夺仗人', [$zcid => $uname]);
                //$iniFile->updItem('夺仗人id', [$zcid => $wjid]);
            } else{
                $q2="gz01";
                $sql = "insert into $q2 (zcid,zlgj,zlgjid,gjjz,gjjzid,czz,czzid)  values('$zcid','$bpmz','$bpid','$xbzmz','$xwjid','$uname','$wjid')";
                if (!mysql_query($sql)){
                    die('Error: ' . mysql_error());
                }
                //更新缓存数据
                $inina="gz01.ini";
                $path='acher/guoz';
                $ininame = $path."/".$inina;
                _unlink($ininame); //删除文件
            }

            ////////////////////更新国战地图神兽大门血量//////////////
            ////////城池大门//////////
            $bossid=1;//世界boss-ID号
            $npcc=$bossid;
            $inina="boss_".$bossid.".ini";
            $path='acher/all_boss';
            $ininame = $path."/".$inina;
            _unlink($ininame); //删除文件
            include("./ini/boss_ini.php");


            ////////中门//////////
            $bossid=2;//世界boss-ID号
            $npcc=$bossid;
            $inina="boss_".$bossid.".ini";
            $path='acher/all_boss';
            $ininame = $path."/".$inina;
            _unlink($ininame); //删除文件
            include("./ini/boss_ini.php");

            ////////守卫//////////
            $bossid=3;//世界boss-ID号
            $npcc=$bossid;
            $inina="boss_".$bossid.".ini";
            $path='acher/all_boss';
            $ininame = $path."/".$inina;
            _unlink($ininame); //删除文件
            include("./ini/boss_ini.php");


            ////////守卫//////////
            $bossid=4;//世界boss-ID号
            $npcc=$bossid;
            $inina="boss_".$bossid.".ini";
            $path='acher/all_boss';
            $ininame = $path."/".$inina;
            _unlink($ininame); //删除文件
            include("./ini/boss_ini.php");

            ////////守卫//////////
            $bossid=5;//世界boss-ID号
            $npcc=$bossid;
            $inina="boss_".$bossid.".ini";
            $path='acher/all_boss';
            $ininame = $path."/".$inina;
            _unlink($ininame); //删除文件
            include("./ini/boss_ini.php");

            ////////守卫//////////
            $bossid=6;//世界boss-ID号
            $npcc=$bossid;
            $inina="boss_".$bossid.".ini";
            $path='acher/all_boss';
            $ininame = $path."/".$inina;
            _unlink($ininame); //删除文件
            include("./ini/boss_ini.php");

            //增加国战积分
            include("./ini/gz03_ini.php");
            $gjjf=($iniFile->getItem('国家积分',$bpid));
            $gjjf=$gjjf+1;
            include("./ini/bpp_ini.php");
            $xl=($iniFile->getItem('序列',$wjid));
            $gj06=($iniFile->getItem('国战积分',$xl));

            if($xl >=1){
                $bpjf=$gj06+1;
                include("./ini/gz03_ini.php");
                $iniFile->updItem('国家积分', [$bpid => $gjjf]);
                include("./ini/gz02_ini.php");
                $xl=($iniFile->getItem('idd',$bpid));
                if($xl >=1){
                    $iniFile->updItem('国家积分', [$xl => $gjjf]);
                    include("./ini/bpp_ini.php");
                    $xl=($iniFile->getItem('序列',$wjid));
                    $iniFile->updItem('国战积分', [$xl => $bpjf]);
                    include("./ini/gz04_ini.php");
                    $jfpd=($iniFile->getItem($wjid,'玩家id'));
                    if($jfpd!=""){
                        include("./ini/gz04_ini.php");
                        $iniFile->updItem('个人积分', [$wjid => $gjjf]);
                    } else{
                        include("./sql/mysql.php");//调用数据库连接
                        $q2="gz04";
                        $sql1=mysql_query("select MAX(id) from $q2");
                        $abc=mysql_fetch_array($sql1);
                        $maxid=$abc[0];
                        if($maxid ==""){
                            $maxid=0;
                        }
                        include("./ini/zt_ini.php");
                        $uname=($iniFile->getItem('玩家信息','玩家名字'));
                        $q2="gz04";
                        $maxidd=$maxid+1;
                        $sql = "insert into $q2 (id,wjid,wjname,wjgzjf,wjlq)  values('$maxidd','$wjid','$uname','$gjjf','1')";
                        if (!mysql_query($sql)) {
                            die('Error: ' . mysql_error());
                        }
                        //更新缓存数据
                        $inina="gz04.ini";
                        $path='acher/guoz';
                        $ininame = $path."/".$inina;
                        _unlink($ininame); //删除文件
                    }

                    echo "<font color=black>获得国家积分+10</font>"."<br>";
                } else{
                    echo "<font color=blue>不会获得任何积分（造成这种情况因为之前参加国战后没有出去过，请自行解决否则不会获得任何积分）</font>"."<br>";
                }
            } else{
                echo "<font color=blue>不会获得任何积分（造成这种情况因为之前参加国战后没有出去过，请自行解决否则不会获得任何积分）</font>"."<br>";
            }

            include("./ini/gz06_ini.php");//更新防守时间
            $enddate=date('Y-m-d H:i:s');
            $iniFile->updItem('防守时间', ['初始' => $enddate]);
            $iniFile->updItem('防守国家', ['初始' => $bpmz]);
            $iniFile->updItem('防守国家id', ['初始' => $bpid]);

            $file01="./acher/guoz/zlbp.php";
            _unlink($file01); //删除文件
            $xtmsg=2;
            $zlbp='$zlbp';
            file_put_contents($file01,"<?php
$zlbp=".$bpid.";

?>");
            $xtxx="【国家权杖】被".$bpmz."国家的".$uname."夺走了,现在".$bpmz."国家变更为防守方";
            include("./msg/msgg02.php");
            echo "<font color=black>恭喜你！你的国家".$bpmz."获得了【国家权杖】现在变为防守方请好好守护权杖吧！</font>"."<br>";
            echo "<br>";
            echo "<br>";
            $cmid=$cmid+1;
            $cdid[]=$cmid;
            $clj[]=2;
            $npc[]=0;
            echo "<a href='xy.php?uid=$wjid&&cmd=$cmid&&sid=$a1'><font color=blue>返回游戏</font></a>"."<br>";
        } else{
            echo "<font color=black>无间道么！你怎么可以夺取自己国家的【国家权杖】？</font>"."<br>";
            echo "<br>";
            $cmid=$cmid+1;
            $cdid[]=$cmid;
            $clj[]=2;
            $npc[]=0;
            echo "<a href='xy.php?uid=$wjid&&cmd=$cmid&&sid=$a1'><font color=blue>返回游戏</font></a>"."<br>";
        }
    } else{
        echo "<font color=black>对不起！【国家权杖】已被".$zlgj."的".$czz."夺走了！！</font>"."<br>";
        echo "<br>";
        $cmid=$cmid+1;
        $cdid[]=$cmid;
        $clj[]=20;
        $npc[]=158;
        echo "<a href='xy.php?uid=$wjid&&cmd=$cmid&&sid=$a1'><font color=blue>返回国战入口</font></a>"."<br>";
    }
} else{
    echo "<font color=black>对不起！你还未加入国家！！</font>"."<br>";
    echo "<br>";
    $cmid=$cmid+1;
    $cdid[]=$cmid;
    $clj[]=2;
    $npc[]=0;
    echo "<a href='xy.php?uid=$wjid&&cmd=$cmid&&sid=$a1'><font color=blue>返回游戏</font></a>"."<br>";
}

echo "<font color=black>----------------------</font>"."<br>";
//cmd及超链接值
include("fhgame.php");














?>