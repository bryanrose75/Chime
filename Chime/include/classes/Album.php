<?php
	class Album {

		private $con;
		private $id;

		public function __construct($con, $id) {
			$this->con = $con;
            $this->id = $id;
            
            $query = mysqli_query($this->con, "SELECT * FROM albums WHERE albumId='$this->id'");
            $album = mysqli_fetch_array($query);
            
            $this->title = $album['title'];
            $this->artistId = $album['artist'];
            $this->genre = $album['genre'];
            $this->artworkPath = $album['artworkPath'];
		}

		public function getTitle() {
			
			return $this->title;
        }
        
        public function getArtist() {
		
			return new Artist($this->con, $this->artistId);
        }
        public function getArtworkPath() {
		
			return $this->artworkPath;
        }
        public function getGenre() {
		
			return $this->genre;
        }
        
        public function getNumberOfSongs() {
			$query = mysqli_query($this->con, "SELECT song_id FROM songs WHERE album='$this->id'");
			return mysqli_num_rows($query);
        }
        
        public function getSongIds() {

			$query = mysqli_query($this->con, "SELECT song_id FROM songs WHERE album='$this->id' ORDER BY albumOrder ASC");

			$array = array();

			while($row = mysqli_fetch_array($query)) {
				array_push($array, $row['song_id']);
			}

			return $array;

		}
	}
?>