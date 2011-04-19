class AddCarsAndFuels < ActiveRecord::Migration
	def self.up
		create_table :cars_fuels, :id => false do |t|
			t.references :car, :fuel
		end
	end

	def self.down
		drop_table :cars_fuels
	end
end
