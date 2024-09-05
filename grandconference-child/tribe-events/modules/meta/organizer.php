<?php
/**
 * Single Event Meta (Organizer) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/organizer.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 */

$organizer_ids = tribe_get_organizer_ids();
$multiple = count( $organizer_ids ) > 1;
$event_id             = Tribe__Main::post_id_helper();
$phone = tribe_get_organizer_phone();
$email = tribe_get_organizer_email();
$website = tribe_get_organizer_website_link();
$website_title = tribe_events_get_organizer_website_title();
$lan = get_field('language',$event_id);
$box_organizer = get_field('box_organizer','option');
$organizer = ($lan === 'french')? $box_organizer['organizer_fr'] : $box_organizer['organizer'];
$phone_title = ($lan === 'french')? $box_organizer['phone_fr'] : $box_organizer['phone'];
$email_title = ($lan === 'french')? $box_organizer['email_fr'] : $box_organizer['email'];
$view_organizer_website = ($lan === 'french')? $box_organizer['view_organizer_website_fr'] : $box_organizer['view_organizer_website'];
$url     = tribe_get_event_meta( $event_id, '_OrganizerWebsite', true );
?>

<div class="tribe-events-meta-group tribe-events-meta-group-organizer">
	<h2 class="tribe-events-single-section-title"><?php echo $organizer; ?></h2>
	<dl>
		<?php
		do_action( 'tribe_events_single_meta_organizer_section_start' );

		foreach ( $organizer_ids as $organizer ) {
			if ( ! $organizer ) {
				continue;
			}

			?>
			<dt
				class="tribe-common-a11y-visual-hide"
				aria-label="<?php echo sprintf(
					/* Translators: %1$s is the customizable organizer term, e.g. "Organizer". %2$s is the customizable event term in lowercase, e.g. "event". %3$s is the customizable organizer term in lowercase, e.g. "organizer". */
					esc_html_x( '%1$s name: This represents the name of the %2$s %3$s.', 'the-events-calendar' ),
					tribe_get_organizer_label_singular(),
					tribe_get_event_label_singular_lowercase(),
					tribe_get_organizer_label_singular_lowercase()
				) ; ?>"
			>
				<?php // This element is only present to ensure we have a valid HTML, it'll be hidden from browsers but visible to screenreaders for accessibility. ?>
			</dt>
			<dd class="tribe-organizer">
				<?php echo tribe_get_organizer_link( $organizer ) ?>
			</dd>
			<?php
		}

		if ( ! $multiple ) { // only show organizer details if there is one
			if ( ! empty( $phone ) ) {
				?>
				<dt class="tribe-organizer-tel-label">
					<?php echo $phone_title; ?>
				</dt>
				<dd class="tribe-organizer-tel">
					<?php echo esc_html( $phone ); ?>
				</dd>
				<?php
			}//end if

			if ( ! empty( $email ) ) {
				?>
				<dt class="tribe-organizer-email-label">
					<?php echo $email_title; ?>
				</dt>
				<dd class="tribe-organizer-email">
					<?php echo esc_html( $email ); ?>
				</dd>
				<?php
			}//end if

			if ( ! empty( $website ) ) {
				?>
				<?php if ( ! empty( $website_title ) ): ?>
					<dt class="tribe-organizer-url-label">
						<?php echo esc_html( $website_title ) ?>
					</dt>
				<?php else: ?>
					<dt
						class="tribe-common-a11y-visual-hide"
						aria-label="<?php echo sprintf(
							/* Translators: %1$s is the customizable organizer term, e.g. "Organizer". %2$s is the customizable event term in lowercase, e.g. "event". %3$s is the customizable organizer term in lowercase, e.g. "organizer". */
							esc_html_x( '%1$s website title: This represents the website title of the %2$s %3$s.', 'the-events-calendar' ),
							tribe_get_organizer_label_singular(),
							tribe_get_event_label_singular_lowercase(),
							tribe_get_organizer_label_singular_lowercase()
						) ; ?>"
					>
						<?php // This element is only present to ensure we have a valid HTML, it'll be hidden from browsers but visible to screenreaders for accessibility. ?>
					</dt>
				<?php endif; ?>
				<dd class="tribe-organizer-url">
				<a href="<?php echo $url;?>" target="_self" rel="external"><?php echo $view_organizer_website; ?></a>
				</dd>
				<?php
			}//end if
		}//end if

		do_action( 'tribe_events_single_meta_organizer_section_end' );
		?>
	</dl>
</div>
