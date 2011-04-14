class RenameCityForeignKeyFromClients < ActiveRecord::Migration
	def self.up
		rename_column :clients, :state_id, :city_id
	end
	def self.down
		rename_column :clients, :city_id, :state_id
	end
end
