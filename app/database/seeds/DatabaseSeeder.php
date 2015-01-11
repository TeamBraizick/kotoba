<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//Eloquent::unguard();

		$this->call('OriginalSentenceTableSeeder');
		$this->command->info('OrignalSentence table seeded!');

		$this->call('TranslatedSentenceTableSeeder');
		$this->command->info('TranslatedSentence table seeded!');

		$this->call('WordsTableSeeder');
		$this->command->info('Words table seeded!');
	}
}
