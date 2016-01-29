<?php

/**
 * Retrieve ID of current git HEAD.
 *
 *
 */



class CommitPrint {

	private $pathToGit;

	/**
	 * Default constructor.
	 *
	 * @param 	string 		Optional. Path to the git folder.
	 */
	public function __construct($gitPath='.git/') {
		$this->pathToGit = $gitPath;
	}

	/**
	 * Shortcut for getCommit.
	 *
	 * @return 	string
	 */
	public function get() {
		return $this->getCommit();
	}

	/**
	 * Get the name or path of the current branch.
	 *
	 * @param 	bool 	Return the name if true. Return the full ref path if false.
	 * @return 	string 	The name of path of the current branch.
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
	 * Get the commit ID of HEAD.
	 *
	 * @return 	string 		Commit ID.
	 */
	public function getCommit() {
		$branch = $this->getBranch(false);
		$commit = $this->getGitFileContents($branch);
		return $commit;
	}


	/**
	 * @return 	string
	 */
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
