<?php

App::uses('Component', 'Controller');

class GalleryComponent extends Component {

	public $controller = null;

	public function recursedir($path, $print = false) {
		$dir = 'source';
		if ($handle = opendir($path)) {
			while ($file = readdir($handle)){
				if ($print) {
					$this->log("\n<li>$path/$file</li>");
				}
				if (! is_dir($path . DS . $file) && $file != '.' && $file != '..') {
					$this->_dataProcess($path, $file);

				} elseif (is_dir($path . DS . $file) && $file != '.' && $file != '..') {
					if ($print) {
						$this->log("\n<ul>");
					}

					$this->recursedir($path . DS . $file);
					if ($print) {
						$this->log("</ul>");
					}
				}
			}
		}
		return true;
	}

	protected function _dataProcess($path, $file, $extend = array()) {
		$extends = array('source');
		$split = explode('/', $path);
		$splitPath = end($split);

		if (!file_exists($path . DS . $extends[0])) {
			if ($splitPath != $extends[0]) {
				mkdir($path . DS . $extends[0], 0755, false);
				$this->log($extends[0] . ' folder created');
			}
		}

		if ($splitPath != $extends[0]) {
			if (file_exists($path . DS . $extends[0] . DS . $file)) {
				$this->_imgProcess($path, $file);
				return;
			}

			$thumb = substr($file, 0, 6);
			if ($thumb == 'thumb_') {
				$this->log('Thumb not copied');
				return;
			}

			copy($path . DS . $file, $path . DS .$extends[0] . DS . $file);
			$this->log($file . ' has been copied to ' . $path . DS . $extends[0]);
		}
	}

	protected function _imgProcess($path, $file) {
		$imgpath = $path . DS . $file;
		$imgtype = exif_imagetype($imgpath);

		if ($imgtype === IMAGETYPE_JPEG) {

			$thumb = substr($file, 0, 6);
			if ($thumb == 'thumb_') {
				$this->log($file. ' not optimize');
				return;
			}

			$optimizefile = $this->_optimize_jpeg($path . DS . $file);
		}

		if ($imgtype === IMAGETYPE_PNG) {

			$thumb = substr($file, 0, 6);
			if ($thumb == 'thumb_') {
				$this->log($file. ' not optimize');
				return;
			}

			$optimizefile = $this->_optimize_png($path . DS . $file);
		}

		if ($optimizefile) {
			$this->log($imgpath . ' has been optimized');
		} else {
			$this->log($imgpath . ' failed to optimized');
		}
	}

	protected function _optimize_jpeg($file) {
		$jpegConfig = Configure::read('Gallery.quality');
		if (!$jpegConfig || !is_numeric($jpegConfig)) {
			return false;
		}

		if ($jpegConfig > 100 || $jpegConfig <= 0) {
			$jpegConfig = 80;
		}

		list($w,$h) = @getimagesize($file);
		if(empty($w) || empty($h)) {
			return false;
		}
		$src = imagecreatefromjpeg($file);
		$tmp = imagecreatetruecolor($w,$h);
		imagecopyresampled($tmp,$src,0,0,0,0,$w,$h,$w,$h);
		$src = imagejpeg($tmp,$file,$jpegConfig);
		if ($src == true) {
//			$this->log('success');
		} elseif ($src == false) {
//			$this->log('failed');
		}
		imagedestroy($tmp);
		return true;
	}

	protected function _optimize_png($file) {
		$pngConfig = Configure::read('Gallery.quality');
		if (!$pngConfig || !is_numeric($pngConfig)) {
			return false;
		}

		if ($pngConfig > 100 || $pngConfig <= 0) {
			$pngConfig = 80;
		}

		list($w,$h) = @getimagesize($file);
		if(empty($w) || empty($h)) {
			return false;
		}
		$src = imagecreatefrompng($file);
		$tmp = imagecreatetruecolor($w,$h);
		imagecopyresampled($tmp,$src,0,0,0,0,$w,$h,$w,$h);
		$src = imagepng($tmp,$file,$pngConfig);
		imagedestroy($tmp);
		return true;
	}

	function _getDirectorySize($path) {
		$totalsize = 0;
		$totalcount = 0;
		$dircount = 0;
		if ($handle = opendir ($path)) {
			while (false !== ($file = readdir($handle))) {
				$nextpath = $path . '/' . $file;
				if ($file != '.' && $file != '..' && !is_link ($nextpath)) {
					if (is_dir ($nextpath)) {
						$dircount++;
						$result = $this->_getDirectorySize($nextpath);
						$totalsize += $result['size'];
						$totalcount += $result['count'];
						$dircount += $result['dircount'];
					} elseif (is_file ($nextpath)) {
						$totalsize += filesize ($nextpath);
						$totalcount++;
					}
				}
			}
		}
		closedir ($handle);
		$total['size'] = $totalsize;
		$total['count'] = $totalcount;
		$total['dircount'] = $dircount;
		return $total;
	}

	protected function _sizeFormat($size) {
		if($size < 1024) {
			return $size." bytes";

		} else if($size<(1024*1024)) {
			$size=round($size/1024,1);
			return $size." KB";

		} else if($size<(1024*1024*1024)) {
			$size=round($size/(1024*1024),1);
			return $size." MB";

		} else {
			$size=round($size/(1024*1024*1024),1);
			return $size." GB";
		}
	}

}
