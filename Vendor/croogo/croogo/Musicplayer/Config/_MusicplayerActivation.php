<?php
/**
 * Example Activation
 *
 * Activation class for Example plugin.
 * This is optional, and is required only if you want to perform tasks when your plugin is activated/deactivated.
 *
 * @package  Croogo
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class MusicplayerActivation {

	public function beforeActivation(&$controller) {
		return true;
	}

/**
 * Called after activating the plugin in ExtensionsPluginsController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
	public function onActivation(&$controller) {
		// ACL: set ACOs with permissions
		$controller->Croogo->addAco('Musicplayer/Musicplayers/get_musicplayer', array('registered', 'public', 'admin', 'moderator'));
		$controller->Croogo->addAco('Musicplayer/Musicplayers/admin_index', array('admin'));
                $controller->Croogo->addAco('Musicplayer/Musicplayers/admin_view', array('admin'));
		$controller->Croogo->addAco('Musicplayer/Musicplayers/admin_add', array('admin'));
                $controller->Croogo->addAco('Musicplayer/Musicplayers/admin_edit', array('admin'));
		$controller->Croogo->addAco('Musicplayer/Playlists/admin_index', array('admin'));
                $controller->Croogo->addAco('Musicplayer/Playlists/admin_view', array('admin'));
		$controller->Croogo->addAco('Musicplayer/Playlists/admin_add', array('admin'));
                $controller->Croogo->addAco('Musicplayer/Playlists/admin_edit', array('admin'));
		$controller->Croogo->addAco('Musicplayer/Track/admin_index', array('admin'));
                $controller->Croogo->addAco('Musicplayer/Track/admin_view', array('admin'));
		$controller->Croogo->addAco('Musicplayer/Track/admin_add', array('admin'));
                $controller->Croogo->addAco('Musicplayer/Track/admin_edit', array('admin'));
	}

	public function beforeDeactivation(&$controller) {
		return true;
	}

/**
 * Called after deactivating the plugin in ExtensionsPluginsController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
	public function onDeactivation(&$controller) {
		$controller->Croogo->removeAco('Musicplayer');
	}
}
?>