class AddCarsAndConcessionaires < ActiveRecord::Migration
	def self.up
		create_table :cars_concessionaires, :id => false do |t|
			t.references :car, :concessionaires
		end
	end

	def self.down
		drop_table :cars_concessionaires
	end
end
