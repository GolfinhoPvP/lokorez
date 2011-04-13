class RenameAllForeignKey < ActiveRecord::Migration
	def self.up
		rename_column :auctions, :car_code, :car_id
		rename_column :cars, :mod_code, :model_id
		rename_column :cities, :est_code, :estate_id
		rename_column :clients, :cit_code, :city_id
		rename_column :models, :ass_code, :assembler_id
	end
	def self.down
		rename_column :models, :assembler_id, :ass_code
		rename_column :client, :city_id, :cit_code
		rename_column :cities, :estate_id, :est_code
		rename_column :cars, :model_id, :mod_code
		rename_column :auctions, :car_id, :car_code
	end
end
