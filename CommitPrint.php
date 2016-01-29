<?php



/**
 *
 *
 *
 */



class CommitPrint {

	private $pathToGit;

	/**
	 *
	 *
	 */
	public function __construct($gitPath='.git/') {
		$this->pathToGit = $gitPath;
	}

	/**
	 *
	 *
	 */
	public function get() {
		return $this->getCommit();
	}

	/**
	 *
	 *
	 */
	public function getBranch($name=true) {
		$head = $this->getGitFileContents('HEAD');
		
		if ($name) {
			$char = '/';
		}
		else {
			$char = ' ';
		}

		$pos = strrpos($head, $char);

		return trim(substr($head, $pos), "/ \t\n\r\0\x0B");
	}

	/**
	 *
	 *
	 */
	public function getCommit() {
		$branch = $this->getBranch(false);
		$commit = $this->getGitFileContents($branch);
		return $commit;
	}


	private function getGitFileContents($path) {
		$file = $this->pathToGit . $path;

		if (file_exists($file)) {
			if (is_readable($file)) {
				$contents = file_get_contents($file);
			}
			else {
				throw new Exception(sprintf('Permission denied while reading %s', $path));
			}	
		}
		else {
			throw new Exception(sprintf('Could not find %s', $path));
		}

		return $contents;
	}
}
