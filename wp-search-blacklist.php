<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*
Plugin Name: Search Blacklist
Plugin URI: https://github.com/fabriziosalmi/wp-search-blacklist
Description: Block top banned search queries on your Wordpress.
Version: 0.1
Author: Fabrizio Salmi
Author URI: https://github.com/fabriziosalmi
License: GPL
*/

add_action( 'admin_menu', 'searchblacklist_menu' );

function searchblacklist_menu() {
	add_options_page( 'Search Blacklist settings', 'Search Blacklist', 'manage_options', 'wp-search-blacklist', 'searchblacklist_options' );
}

function searchblacklist_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=wp-search-blacklist.php">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'searchblacklist_settings_link' );

/** Step 3. */
function searchblacklist_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';

	echo '<h2>Search Blacklist</h2>';
	echo '<p>Blacklist is currently <span style="color: #00b300;font-weight: bold;">enabled</span> on your website.</p>';
}


add_action('wp', 'check_search');
function check_search() {
    global $wp_query;
    if (!$s = get_search_query())
        return false;
    if (preg_match('/^(butt|geek|gonadatrophia|irrumination|thud|lsat|pizzle|sex|intercourse|coitus|screwing|lovemaking|panty|braless|tampax|lactation|preggers|uterus|condom|sti|morphine|demerol|sunni|iftar|klansmen|supremacist|anal|anus|arse|ass|ballsack|balls|bastard|bitch|biatch|bloody|blowjob|blowjob|bollock|bollok|boner|boob|bugger|bum|butt|buttplug|clitoris|cock|coon|crap|cunt|damn|dick|dildo|dyke|fag|feck|fellate|fellatio|felching|fuck|fuck|fudgepacker|fudgepacker|flange|goddamn|goddamn|hell|homo|jerk|jizz|knobend|labia|lmao|lmfao|muff|nigger|nigga|omg|penis|piss|poop|prick|pube|pussy|queer|scrotum|sex|shit|sh1t|slut|smegma|spunk|tit|tosser|turd|twat|vagina|wank|whore|wtf|4r5e|5h1t|5hit|a55|anal|anus|ar5e|arrse|arse|ass|ass-fucker|asses|assfucker|assfukka|asshole|assholes|asswhole|a_s_s|b!tch|b00bs|b17ch|b1tch|ballbag|balls|ballsack|bastard|beastial|beastiality|bellend|bestial|bestiality|bi+ch|biatch|bitch|bitcher|bitchers|bitches|bitchin|bitching|bloody|blowjob|blowjob|blowjobs|boiolas|bollock|bollok|boner|boob|boobs|booobs|boooobs|booooobs|booooooobs|breasts|buceta|bugger|bum|butt|butthole|buttmuch|buttplug|c0ck|c0cksucker|cawk|chink|cipa|cl1t|clit|clitoris|clits|cnut|cock|cock-sucker|cockface|cockhead|cockmunch|cockmuncher|cocks|cocksuck|cocksucked|cocksucker|cocksucking|cocksucks|cocksuka|cocksukka|cok|cokmuncher|coksucka|coon|cox|crap|cum|cummer|cumming|cums|cumshot|cunilingus|cunillingus|cunnilingus|cunt|cuntlick|cuntlicker|cuntlicking|cunts|cyalis|cyberfuc|cyberfuck|cyberfucked|cyberfucker|cyberfuckers|cyberfucking|d1ck|damn|dick|dickhead|dildo|dildos|dink|dinks|dirsa|dlck|dog-fucker|doggin|dogging|donkeyribber|doosh|duche|dyke|ejaculate|ejaculated|ejaculates|ejaculating|ejaculatings|ejaculation|ejakulate|f4nny|fag|fagging|faggitt|faggot|faggs|fagot|fagots|fags|fanny|fannyflaps|fannyfucker|fanyy|fatass|fcuk|fcuker|fcuking|feck|fecker|felching|fellate|fellatio|fingerfuck|fingerfucked|fingerfucker|fingerfuckers|fingerfucking|fingerfucks|fistfuck|fistfucked|fistfucker|fistfuckers|fistfucking|fistfuckings|fistfucks|flange|fook|fooker|fuck|fucka|fucked|fucker|fuckers|fuckhead|fuckheads|fuckin|fucking|fuckings|fuckingshitmotherfucker|fuckme|fucks|fuckwhit|fuckwit|fudgepacker|fudgepacker|fuk|fuker|fukker|fukkin|fuks|fukwhit|fukwit|fux|fux0r|f_u_c_k|gangbang|gangbanged|gangbangs|gaylord|gaysex|goatse|god-dam|god-damned|goddamn|goddamned|hardcoresex|hell|heshe|hoar|hoare|hoer|homo|hore|horniest|horny|hotsex|jack-off|jackoff|jap|jerk-off|jism|jiz|jizm|jizz|kawk|knob|knobead|knobed|knobend|knobhead|knobjocky|knobjokey|kock|kondum|kondums|kum|kummer|kumming|kums|kunilingus|l3i+ch|l3itch|labia|lmfao|lust|lusting|m0f0|m0fo|m45terbate|ma5terb8|ma5terbate|masochist|master-bate|masterb8|masterbat|masterbat3|masterbate|masterbation|masterbations|masturbate|mo-fo|mof0|mofo|mothafuck|mothafucka|mothafuckas|mothafuckaz|mothafucked|mothafucker|mothafuckers|mothafuckin|mothafucking|mothafuckings|mothafucks|motherfucker|motherfuck|motherfucked|motherfucker|motherfuckers|motherfuckin|motherfucking|motherfuckings|motherfuckka|motherfucks|muff|mutha|muthafecker|muthafuckker|muther|mutherfucker|n1gga|n1gger|nazi|nigg3r|nigg4h|nigga|niggah|niggas|niggaz|nigger|niggers|nob|nobhead|nobjocky|nobjokey|numbnuts|nutsack|orgasim|orgasims|orgasm|orgasms|p0rn|pawn|pecker|penis|penisfucker|phonesex|phuck|phuk|phuked|phuking|phukked|phukking|phuks|phuq|pigfucker|pimpis|piss|pissed|pisser|pissers|pisses|pissflaps|pissin|pissing|pissoff|poop|porn|porno|pornography|pornos|prick|pricks|pron|pube|pusse|pussi|pussies|pussy|pussys|rectum|retard|rimjaw|rimming|shit|s.o.b.|sadist|schlong|screwing|scroat|scrote|scrotum|semen|sex|sh!+|sh!t|sh1t|shag|shagger|shaggin|shagging|shemale|shi+|shit|shitdick|shite|shited|shitey|shitfuck|shitfull|shithead|shiting|shitings|shits|shitted|shitter|shitters|shitting|shittings|shitty|skank|slut|sluts|smegma|smut|snatch|son-of-a-bitch|spac|spunk|s_h_i_t|t1tt1e5|t1tties|teets|teez|testical|testicle|tit|titfuck|tits|titt|tittie5|tittiefucker|titties|tittyfuck|tittywank|titwank|tosser|turd|tw4t|twat|twathead|twatty|twunt|twunter|v14gra|v1gra|vagina|viagra|vulva|w00se|wang|wank|wanker|wanky|whoar|whore|willies|willy|xrated|xxx)$/i', $s)) {
        $wp_query->set_404();
        status_header(404);
        get_template_part(404);
        exit();
    }
}
