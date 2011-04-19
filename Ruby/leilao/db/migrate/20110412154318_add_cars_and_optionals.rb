class AddCarsAndOptionals < ActiveRecord::Migration
	def self.up
		create_table :cars_optionals, :id => false do |t|
			t.references :car, :optional
		end
	end

	def self.down
		drop_table :cars_optionals
	end
end
