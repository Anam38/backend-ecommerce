
class Guest {
    constructor () {
    }
    check () {
      if (this.token) {
        return true;
      }else {
        return false;
      }
    }
}
export default new Guest();
