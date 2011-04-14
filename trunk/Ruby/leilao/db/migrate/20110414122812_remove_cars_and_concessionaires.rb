class RemoveCarsAndConcessionaires < ActiveRecord::Migration
	def self.up
		drop_table :cars_concessionaires
	end
	def self.down
		create_table :cars_concessionaires, :id => false do |t|
			t.references :car, :concessionaires
		end
	end
end
