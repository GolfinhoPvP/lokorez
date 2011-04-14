class RenameStateForeignKeyFromCities < ActiveRecord::Migration
	def self.up
		rename_column :cities, :estate_id, :state_id
	end
	def self.down
		rename_column :cities, :state_id, :estate_id
	end
end
