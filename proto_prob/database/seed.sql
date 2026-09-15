INSERT INTO site_interest_tags (slug, label, description) VALUES
('event_updates', 'Event updates', 'Fan or attendee wants July 25 free show updates and RSVP reminders.'),
('directions_info', 'Directions, camping, and parking', 'Lead wants Cycle Moore Legacy arrival, camping, and grass parking details.'),
('media_drops', 'Photos, video, and stage drops', 'Lead wants original media, fan-sharing instructions, and show media updates.'),
('collector_relic_updates', 'Vault and gallery drops', 'Lead wants fan vault, gallery, costume, road-case, and behind-the-scenes updates.'),
('accessibility', 'Safety and access notes', 'Lead needs accessibility, fog, strobe, bright-light, loud-sound, or comfort information.'),
('press', 'Facebook / media / sharing', 'Inquiry relates to Facebook event sharing, media, or public posting.'),
('technical', 'Technical', 'Inquiry relates to stage, lighting, power, effects, or show-control details.'),
('general', 'General question', 'Inquiry relates to general Just One KISS questions.')
ON DUPLICATE KEY UPDATE label = VALUES(label), description = VALUES(description);
