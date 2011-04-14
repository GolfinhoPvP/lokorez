class AddConcessionaireIdToCars < ActiveRecord::Migration
	def self.up
		add_column :cars, :concessionaire_id, :integer
	end

	def self.down
		remove_column :cars, :concessionaire_id
	end
end
