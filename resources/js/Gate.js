export default class Gate {

    constructor(user) {
        this.user = user;
    }

    isAdmin() {
        return this.user.type === '1';
    }

    isUser() {
        return this.user.type === '2';
    }

    isReviewer() {
        return this.user.type === '2';
    }

    isAdminOrReviewer() {
        if (this.user.type === '1' || this.user.type === '2') {
            return true;
        }
    }

    isReviewerOrUser() {
        if (this.user.type === '2' || this.user.type === '2') {
            return true;
        }
    }
}