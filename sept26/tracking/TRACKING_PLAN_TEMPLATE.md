# Tracking Plan — JOK-SEP26

## Control record

- Confirmed year:
- Primary conversion:
- Durable source-of-record definition:
- Attribution window(s):
- Analytics/tag manager/platform stack:
- Consent platform/behavior:
- Measurement owner:
- QA date/environment:

## Event map

| Event | Trigger | Properties | Browser/server | Deduplication key | Consent requirement | QA evidence |
| --- | --- | --- | --- | --- | --- | --- |
| `view_campaign_landing` | | | | | | |
| `start_registration` | | | | | | |
| `complete_registration` | durable success only | | | | | |
| `purchase` | paid completion only | value, currency, order ID | | | | |

## UTM and destination map

| Piece ID | Platform | Placement | Audience | Destination | utm_source | utm_medium | utm_campaign | utm_content | Short/QR URL | QA |
| --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- |

## Reconciliation

Document how platform conversions, analytics events, backend registrations/orders, refunds/cancellations, duplicates, and test records reconcile. Never export PII into URLs or advertising event parameters.
