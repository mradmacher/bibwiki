<?php
  if( $argc < 1 ) {
    echo 'Provide the name of the file you want to import as a first argument.';
    exit( 1 );
  } 
  $file = $argv[1];

  $mongo = new Mongo();
  $collection = $mongo -> eforams -> publications;
  $publications = array();

  $result = array();
  exec( 'bib2x -f ' . $file . ' -t import.template', $result );
  foreach( $result as $line ) {
    if( $line != '' ) {
      $pub = json_decode( $line, true ); 
      $type = str_replace( '@', '', $pub['entry_type'] );
      $pub[ 'entry_type' ] = $type;
      array_push( $publications, $pub );
    }
  }
  $collection -> batchInsert( $publications );
?>
