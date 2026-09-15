<?php
/**
 * Purpose: This footer partial closes the owner shell and will eventually summarize data freshness, active SSOT roots, prototype warnings, validation status, and audit/export availability.
 * Components to populate: freshness footer, settings manifest timestamp, active source root, validation summary, privacy/security notice, JavaScript includes, audit trail shortcut, and future diagnostics drawer.
 */
$config = center_config();
?>
</main>
<footer class="center-footer"><?= center_e($config['prototype_notice']) ?></footer>
</div>
<script src="assets/js/center.js"></script>
</body>
</html>
