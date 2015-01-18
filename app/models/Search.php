<?php

/**
 * Description of Search
 *
 * @author Nick
 */
class Search {

	public static function find($data) {
		$allWords = Words::all();
		$results = [];

		foreach ($allWords as $spec) {
			if (strcasecmp($spec->lang, $data['target']) == 0) {
				foreach (explode(" ", $data['query']) as $query) {
					if (strcasecmp($spec->word, $query) == 0) {
						foreach (unserialize($spec->originals) as $single) {
							$org = OriginalSentence::find($single);
							if (strcasecmp($org->lang, $data['target']) == 0) {
								foreach (unserialize($org->translated) as $trs) {
									$possTrs = TranslatedSentence::find($trs);
									if (strcasecmp($possTrs->lang, $data['known']) == 0) {
										$results[] = ['original' => $org, 'translation' => $possTrs];
									}
								}
							}
						}
					}
				}
			}
		}

		return $results;
	}

}
