CREATE TABLE IF NOT EXISTS site_leads (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  site VARCHAR(120) NOT NULL,
  email VARCHAR(254) NOT NULL,
  name VARCHAR(120) NULL,
  organization VARCHAR(160) NULL,
  city_zip VARCHAR(120) NULL,
  interest_tags_json JSON NOT NULL,
  consent_given TINYINT(1) NOT NULL DEFAULT 0,
  consent_source VARCHAR(255) NOT NULL,
  referrer VARCHAR(500) NULL,
  created_at DATETIME NOT NULL,
  INDEX idx_site_created (site, created_at),
  INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS site_inquiries (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  site VARCHAR(120) NOT NULL,
  category ENUM('general','press','venue_availability','accessibility','directions','ticket','location') NOT NULL,
  email VARCHAR(254) NOT NULL,
  name VARCHAR(120) NULL,
  organization VARCHAR(160) NULL,
  event_date VARCHAR(40) NULL,
  city_state VARCHAR(140) NULL,
  capacity VARCHAR(40) NULL,
  budget VARCHAR(80) NULL,
  facebook_contact VARCHAR(300) NULL,
  technical_constraints TEXT NULL,
  message TEXT NOT NULL,
  consent_given TINYINT(1) NOT NULL DEFAULT 0,
  referrer VARCHAR(500) NULL,
  created_at DATETIME NOT NULL,
  INDEX idx_site_category (site, category),
  INDEX idx_created (created_at),
  INDEX idx_org_city (organization, city_state)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS site_interest_tags (
  id SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  slug VARCHAR(80) NOT NULL UNIQUE,
  label VARCHAR(120) NOT NULL,
  description VARCHAR(255) NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS site_form_events (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  site VARCHAR(120) NOT NULL,
  event_type VARCHAR(80) NOT NULL,
  status VARCHAR(80) NOT NULL,
  payload_json JSON NULL,
  referrer VARCHAR(500) NULL,
  user_agent VARCHAR(500) NULL,
  created_at DATETIME NOT NULL,
  INDEX idx_event_status (event_type, status),
  INDEX idx_site_created (site, created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
