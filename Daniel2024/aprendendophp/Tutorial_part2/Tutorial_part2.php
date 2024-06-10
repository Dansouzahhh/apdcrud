<?php

    $raw = '22.11.1968';
    $start = DateTime::createFromFormat('d.m.Y',$raw);
    
    echo "Data de inicio:".$start->format('Y-m-d')."\n";

    $end = clone $start;
    $end->add(new Dateinterval('P1M6D'));

    $diff = $end->diff($start);
    echo "Diferencia:".$diff->format('%m mes, %d dias (total: %a dias)')."\n";
    //Diferencia: 1mes, 6 dias (total: 37 dias)

    if($start < $end){
        echo "comeca antes do fim!\n";
    }

    $periodInterval = Dateinterval::createFromDateString('first thursday');

    $periodIterator = new DatePeriod($start,$periodInterval,$end,DatePeriod::EXCLUDE_START_DATE);

    foreach($periodIterator as $date){
        //mostra cada data no periodo
        echo $date->format('d-m-Y')." ";
    }
?>
