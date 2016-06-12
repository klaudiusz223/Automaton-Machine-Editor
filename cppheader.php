<?php
include_once "./header.php";

include_once "./lib/libatm.php";

session_start();

include_once "./navigation.php";

$xml = $sm->as_xml();
file_put_contents( "machines/". session_id(). "/new.atml", $xml );

if ( $sm->hash() !== $_SESSION['CHECKSUM'] ) { 
  $r = shell_exec( "./update.sh machines ". session_id() );
  $_SESSION['CHECKSUM'] = $sm->hash(); 
}

echo "<pre><code class='cpp'>\n";

echo htmlentities( file_get_contents( "machines/". session_id(). "/work/Machine.h" ) );

?>
/* 
Automaton::ATML::begin - Automaton Markup Language

<?php echo htmlentities( $sm->as_xml() ) ?>

Automaton::ATML::end 
*/

</code></pre>
<?php include_once "footer.php" ?>
